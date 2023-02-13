<?php
	class JsMinify
	{
		private $pathJs = array();
		private $debugJs;
		private $cacheName = '';
		private $cacheFile = 'assets/js/';
		private $cacheSize = false;
		private $lock = array(
			'status' => false,
			'char' => ''
		);

		function __construct($debugJs, $func)
		{
			$this->debugJs = $debugJs;
			$this->func = $func;
		}

		public function setJs($path)
		{
			$this->pathJs[] = $path;
		}

		public function getJs()
		{
			if(empty($this->pathJs)) die("No files to optimize");
			return ($this->debugJs) ? $this->defaultJs() : $this->miniJs();
		}

		public function setCache($name)
		{
			$this->cacheName = $name;
			$this->cacheFile = $this->cacheFile.$this->cacheName.'.js';
			$this->cacheSize = (file_exists($this->cacheFile)) ? filesize($this->cacheFile) : 0;
		}

		private function miniJs()
		{
			$strJs = '';
			$extension = '';

			if(!$this->cacheSize)
			{
				foreach($this->pathJs as $path)
				{
					$path_parts = pathinfo($path);
					$extension = strtolower($path_parts['extension']);
					if($extension != 'js') die("Invalid file");
					$myfile = fopen($path, "r") or die("Unable to open file");
					$sizefile = filesize($path);
			        if($sizefile) $strJs .= $this->compressJS(fread($myfile,$sizefile));
					fclose($myfile);
				}

				if($strJs)
				{
					$file = fopen($this->cacheFile, "w") or die("Unable to open file");
					fwrite($file, $strJs);
					fclose($file);
				}
			}

			return '<script type="text/javascript" src="'.$this->cacheFile.'"></script>';
		}

		private function defaultJs()
		{
			$linkJs = '';
			$extension = '';

			if($this->cacheSize)
			{
				$file = fopen($this->cacheFile, "r+") or die("Unable to open file");
				ftruncate($file, 0);
				fclose($file);
			}

			foreach($this->pathJs as $path)
			{
				$path_parts = pathinfo($path);
				$extension = strtolower($path_parts['extension']);
				if($extension != 'js') die("Invalid file");
				$linkJs .= '<script type="text/javascript" src="'.$path.'?v='.$this->func->stringRandom(10).'"></script>'.PHP_EOL;
			}

			return $linkJs;
		}

		private function compressJS($js)
		{
		    // Remove single-line code comments
		    $js = preg_replace('/^[\t ]*?\/\/.*\s?/m', '', $js);

		    // Remove end-of-line code comments
		    $js = preg_replace('/([\s;})]+)\/\/.*/m', '\\1', $js);
		    
		    // Remove multi-line code comments
		    $js = preg_replace('/\/\*[\s\S]*?\*\//', '', $js);

		    // Remove leading whitespace
		    $js = preg_replace('/^\s*/m', '', $js);

		    // Replace multiple tabs with a single space
		    $js = preg_replace('/\t+/m', ' ', $js);

		    // Remove newlines
		    $js = preg_replace('/[\r\n]+/', '', $js);

		    // Split input JavaScript by single and double quotes
		    $js_substrings = preg_split('/([\'"])/', $js, -1, PREG_SPLIT_DELIM_CAPTURE);

		    // Empty variable for minified JavaScript
		    $js = '';

		    foreach($js_substrings as $substring)
		    {
		        // Check if substring is split delimiter
		        if($substring === '\'' or $substring === '"')
		        {
		            // If so, check whether minification is unlocked
		            if($this->lock['status'] === false)
		            {
		                // If so, lock it and set lock character
		                $this->lock['status'] = true;
		                $this->lock['char'] = $substring;
		            }
		            else
		            {
		                // If not, check if substring is lock character
		                if($substring === $this->lock['char'])
		                {
		                    // If so, unlock minification
		                    $this->lock['status'] = false;
		                    $this->lock['char'] = '';
		                }
		            }

		            // Add substring to minified output
		            $js .= $substring;
		            continue;
		        }

		        // Minify current substring if minification is unlocked
		        if($this->lock['status'] === false)
		        {
		            // Remove unnecessary semicolons
		            $substring = str_replace(';}', '}', $substring);

		            // Remove spaces round operators
		            $substring = preg_replace('/ *([<>=+\-!\|{(},;&:?]+) */', '\\1', $substring);
		        }

		        // Add substring to minified output
		        $js .= $substring;
		    }

			return trim($js);
		}

		// private function compressJS($buffer)
		// {
		// 	$buffer = str_replace('/// ', '///', $buffer);       
		// 	$buffer = str_replace(',//', ', //', $buffer);
		// 	$buffer = str_replace('{//', '{ //', $buffer);
		// 	$buffer = str_replace('}//', '} //', $buffer);
		// 	$buffer = str_replace('*//*', '*/  /*', $buffer);
		// 	$buffer = str_replace('/**/', '/*  */', $buffer);
		// 	$buffer = str_replace('*///', '*/ //', $buffer);
		// 	$buffer = preg_replace("/\/\/.*\n\/\/.*\n/", "", $buffer);
		// 	$buffer = preg_replace("/\s\/\/\".*/", "", $buffer);
		// 	$buffer = preg_replace("/\/\/\n/", "\n", $buffer);
		// 	$buffer = preg_replace("/\/\/\s.*.\n/", "\n  \n", $buffer);
		// 	$buffer = preg_replace('/\/\/w[^w].*/', '', $buffer);
		// 	$buffer = preg_replace('/\/\/s[^s].*/', '', $buffer);
		// 	$buffer = preg_replace('/\/\/\*\*\*.*/', '', $buffer);
		// 	$buffer = preg_replace('/\/\/\*\s\*\s\*.*/', '', $buffer);
		// 	$buffer = preg_replace('/[^\*]\/\/[*].*/', '', $buffer);
		// 	$buffer = preg_replace('/([;])\/\/.*/', '$1', $buffer);
		// 	$buffer = preg_replace('/((\r)|(\n)|(\R)|([^0]1)|([^\"]\s*\-))(\/\/)(.*)/', '$1', $buffer);
		// 	$buffer = preg_replace("/([^\*])[\/]+\/\*.*[^a-zA-Z0-9\s\-=+\|!@#$%^&()`~\[\]{};:\'\",<.>?]/", "$1", $buffer);
		// 	$buffer = preg_replace("/\/\*/", "\n/*dddpp", $buffer);
		// 	$buffer = preg_replace('/((\{\s*|:\s*)[\"\']\s*)(([^\{\};\"\']*)dddpp)/','$1$4', $buffer);
		// 	$buffer = preg_replace("/\*\//", "xxxpp*/\n", $buffer);
		// 	$buffer = preg_replace('/((\{\s*|:\s*|\[\s*)[\"\']\s*)(([^\};\"\']*)xxxpp)/','$1$4', $buffer);
		// 	$buffer = preg_replace('/([\"\'])\s*\/\*/', '$1/*', $buffer);
		// 	$buffer = preg_replace('/(\n)[^\'"]?\/\*dddpp.*?xxxpp\*\//s', '', $buffer);
		// 	$buffer = preg_replace('/\n\/\*dddpp([^\s]*)/', '$1', $buffer);
		// 	$buffer = preg_replace('/xxxpp\*\/\n([^\s]*)/', '*/$1', $buffer);
		// 	$buffer = preg_replace('/xxxpp\*\/\n([\"])/', '$1', $buffer);
		// 	$buffer = preg_replace('/(\*)\n*\s*(\/\*)\s*/', '$1$2$3', $buffer);
		// 	$buffer = preg_replace('/(\*\/)\s*(\")/', '$1$2', $buffer);
		// 	$buffer = preg_replace('/\/\*dddpp(\s*)/', '/*', $buffer);
		// 	$buffer = preg_replace('/\n\s*\n/', "\n", $buffer);
		// 	$buffer = preg_replace("/([^\'\"]\s*)<!--.*-->(?!(<\/div>)).*/","$1", $buffer);
		// 	$buffer = preg_replace('/([^\n\w\-=+\|!@#$%^&*()`~\[\]{};:\'",<.>\/?\\\\])(\/\/)(.*)/', '$1', $buffer);
		// 	$buffer = preg_replace('/\s+/', ' ', $buffer);
		// 	# $buffer = preg_replace('/\s*(?:(?=[=\-\+\|%&\*\)\[\]\{\};:\,\.\<\>\!\@\#\^`~]))/', '', $buffer);
		// 	$buffer = preg_replace('/(?:(?<=[=\-\+\|%&\*\)\[\]\{\};:\,\.\<\>\?\!\@\#\^`~]))*/', '', $buffer);
		// 	$buffer = preg_replace('/([^a-zA-Z0-9\s\-=+\|!@#$%^&*()`~\[\]{};:\'",<.>\/?])\s+([^a-zA-Z0-9\s\-=+\|!@#$%^&*()`~\[\]{};:\'",<.>\/?])/', '$1$2', $buffer);

		// 	return $buffer;
		// }
	}
?>