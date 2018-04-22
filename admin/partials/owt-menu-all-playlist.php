<div class="panel panel-primary">
    <div class="panel-heading">All Playlists</div>
    <div class="panel-body">
        <table id="example-owt" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>Thumbnail</th>
                    <th>Users Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $wpdb;
                $all_playlists = $wpdb->get_results(
                        $wpdb->prepare(
                                "SELECT * from " . $this->tables->owtboliertable() . " Order by id desc", ""
                        ), ARRAY_A
                );


                if (count($all_playlists) > 0) {
                    $i = 1;
                    foreach ($all_playlists as $index => $data) {
                        
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['name'] ?></td>
                            <td><img src="<?php echo $data['thumbnail']; ?>" style="height: 80px;width:80px"/></td>
                            <td>
                                <?php
                                   $users_level = (array)json_decode($data['playlist_for']);
                                   foreach($users_level as $level){
                                       echo ucfirst($level)." , ";
                                   }
                                ?>
                            </td>
                            
                            <td>
                                <a href="javascipt:void(0)" class="btn btn-info">Edit</a>
                                <a href="javascipt:void(0)" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<h4>No Playlist found</h4>";
                }
                ?>
        </table>
    </div>
</div>