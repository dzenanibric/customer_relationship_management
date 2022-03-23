<?php submitComplaint(); ?>

<div class="container">
        <div class="user_screen">
            <h1><?php $user=getUser(); echo $user['first_name']; ?>, welcome!</h1>
            <p>Below you can write your complaints and comments about our services to help us improve our service!</p>
            <form method = "POST">
                <textarea name="write_complaints" id="complaints_input" cols="100" rows="5" required></textarea>
                <input type="submit" name = "submit-complaints" value = "Submit">
            </form>
        </div>
</div>