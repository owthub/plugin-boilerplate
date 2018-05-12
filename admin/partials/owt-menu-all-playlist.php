
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
            <tbody id="boiler-table-playlist">
                <?php
                   ob_start(); // start the buffer
                   // include file
                   
                   include_once OWT_BOILER_PLAGIN_DIR."/admin/partials/tmpl/plugin-tmpl-playlists.php";
                   // read the buffer
                   $template = ob_get_contents();
                   // close the buffer
                   ob_end_clean();
                   
                   echo $template;
                ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div id="boiler-edit-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>