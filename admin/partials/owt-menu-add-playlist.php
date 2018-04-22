<?php wp_enqueue_media(); ?>

<div class="panel panel-primary">
    <div class="panel-heading">Add Playlist</div>
    <div class="panel-body">
        <form class="form-horizontal" action="javascript:void(0)" id="frmAddPlaylists">
            <div class="form-group">
                <label class="control-label col-sm-2" for="text">Playlist Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required="" placeholder="Enter Playlist Name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="image">Upload Thumbnail:</label>
                <div class="col-sm-10">
                    <button class="btn btn-info" type="button" id="media-upload">Upload Image</button>
                    <span><img src="" id="media-image" style="height: 100px;width:100px"/></span>
                    <input type="hidden" id="image-url" name="image_url"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="text">Playlist For:</label>
                <div class="col-sm-10">
                    <?php $levels_array = array("beginners", "intermediates", "experts"); ?>

                    <?php
                    foreach ($levels_array as $level) {
                        ?>
                       <input type="checkbox" name="level[]" class="form-control" value="<?php echo $level ?>"/> <?php echo ucfirst($level); ?> <br/>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>