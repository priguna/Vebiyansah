<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title"><i class='fas fa-wrench'></i> | Generate Update</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body modal-body-1">     
    <table width="100%">
      <tr>
        <td>          
          <div class="progress">
            <div class="progress-bar bg-primary progress-bar-striped" id="progress_generate" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
          </div>
        </td>
        <td style="width: 50px" id="progress_generate_persen">0 %</td>
      </tr>
    </table>  
  </div>
  <div class="modal-body modal-body-2" style="height: 350px; overflow-y: auto;">      
    <div class="table-responsive" >
      <table class="table table-sm table-bordered table-striped table-hover tabel-generate">
        <thead>
          <tr>           
            <th style="text-align: center;">No</th>
            <th style="text-align: center;">Filename</th>
            <th style="text-align: center;">Direktori</th>
            <th style="text-align: center;">Versi</th>
            <th style="text-align: center;">Modified Date</th>
            <th style="text-align: center;">Response</th>
          </tr>
        </thead>
        <tbody id="data_generate">         
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" class="close"><i class="fas fa-times"></i> Batal</button>
  </div>
</div>