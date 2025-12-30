<div class="container">
    <div class="banner wow bounceInLeft">
        <div class="row">
            <?php
            require_once(__DIR__ . '/connect.php');
            $sql = "SELECT image FROM slides WHERE status=3";
            $result = mysqli_query($conn, $sql);

            while ($kq = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-2 col-sm-4 col-xs-6 text-center">
                    <div class="thumbnail">
                        <div class="hoverimage1">
                            <img src="<?php echo str_replace('../', '', $kq['image']); ?>" alt="..." width="100%" height="160">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>