<?php if (common::is_logged_in()): ?>
    <div class="top_menu">
        <ul class="sf-menu">
            <li><a href="<?=site_url('home') ?>" title='Home' class="white">Home</a></li>
            <li class="current"><a href="#a" class="white">Settings</a>
                <ul>
                    <li><a href="#user">Site Users</a>
                        <ul>
                            <li><a href="<?=site_url('user') ?>">Manage Users</a></li>
                            <li class="round"><a href="<?=site_url('user/new_user') ?>">Add New User</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="current"><a class="white">Questions</a>
                <ul>
                    <li><a href="<?=site_url('question') ?>">Manage Questions</a></li>
                    
                </ul>    

            </li>
			<li><a href="<?=site_url('result') ?>" title='Result' class="white">Result</a></li>
        </ul>
    </div>
    <div class="clear"></div>
<?php endif; ?>