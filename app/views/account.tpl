<main>
    <div>
        <header>
            <ul class="list middle">
                <li>
                    <span class="primary active icon gray">
                        <a href="<?php echo \Movim\Route::urlize('main'); ?>">
                            <i class="material-icons">home</i>
                        </a>
                    </span>
                    <p class="center"><?php echo __('page.account_creation'); ?></p>
                </li>
            </ul>
        </header>
        <?php $this->widget('Subscribe');?>
    </div>
</main>
