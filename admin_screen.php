<div class="container">
    <div class="admin_screen">
        <h1>Admin Dashboard</h1>
            <div class="admin_nav">
                <li><a href="add_user.php">Add user</a></li>
                <li><a href="complaints.php">Complaints</a></li>
            </div>
        <div class="dashboard">
            <div class="col">
                <h1>Categories</h1><hr>
                <div class="categories">
                    <ul>
                        <li><div style="display:none;" id="cat-one"><?php showCategory('category_one'); ?></div></li>
                        <input id="btn-one" type="button" value="Category 1" onclick="showDiv('cat-one', 1, 'btn-one')"/>

                        <li><div style="display:none;" id="cat-two"><?php showCategory('category_two'); ?></div></li>
                        <input id="btn-two" type="button" value="Category 2" onclick="showDiv('cat-two' , 2, 'btn-two')"/>
                    </ul>
                </div>
            </div>
            <div class="col">
                <h1>Stats</h1><hr>
                <?php echo getNumberOf('users' , 'Users');?>
                <br>
                <?php echo getNumberOf('complaints', 'Unclassified complaints'); ?>
                <br>
                <?php echo getNumberOf('category_one', 'Complaints in Category 1'); ?>
                <br>
                <?php echo getNumberOf('category_two', 'Complaints in Category 2'); ?>
                <br>
                <?php getBiggestCategory(); ?>

                <div class="settings">
                    <hr id="top-hr"><h1>Other settings</h1><hr>
                    <a href="reset_crm.php">Reset CRM</a>
                </div>
                
                <hr><h1>List of all users</h1><hr>

                <div class="list_all_users">
                    <?php printAllUsers(); ?>
                </div>
            </div>
        </div>
    </div>
</div>