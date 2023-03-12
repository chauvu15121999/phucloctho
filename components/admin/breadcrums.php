<?php 
class Breadcrums {
    function renderBreadcrums (  $breadcrumsArr = [] ) {
        ?>
          <div class="bc">
                <ul id="breadcrumbs" class="breadcrumbs d-flex mb-0 p-0">
                    <?
                        foreach ($breadcrumsArr as $index => $li) {
                            ?> 
                            <li class="<?= $li['current']?>">
                                <a href="<?= $li['link'] ?>" ><?= $li['title'] ?></a>
                            </li>
                        <? } 
                    ?>
                </ul>
            </div>
        <?php
    }
}