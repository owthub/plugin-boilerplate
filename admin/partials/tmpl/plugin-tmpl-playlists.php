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
                $users_level = (array) json_decode($data['playlist_for']);
                foreach ($users_level as $level) {
                    echo ucfirst($level) . " , ";
                }
                ?>
            </td>

            <td>
                <a href="javascipt:void(0)" class="btn btn-info cust-plugin-edit" data-toggle="modal" data-target="#boiler-edit-modal">Edit</a>
                <a href="javascipt:void(0)" class="btn btn-danger cust-plugin-delete" data-id="<?php echo $data['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<h4>No Playlist found</h4>";
}
?>

        