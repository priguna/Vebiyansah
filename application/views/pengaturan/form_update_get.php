<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title"><i class='fas fa-download'></i> | Get Update</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body modal-body-1">     
    <table width="100%">
      <tr>
        <td style="width: 70px">Files</td>
        <td>          
          <div class="progress">
            <div class="progress-bar bg-danger progress-bar-striped" id="progress_content" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
          </div>
        </td>
        <td style="width: 50px" id="progress_content_persen">0 %</td>
      </tr>
      <tr>
        <td style="width: 70px">Database</td>
        <td>          
          <div class="progress">
            <div class="progress-bar bg-success progress-bar-striped" id="progress_database" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            <input type="hidden" name="jml_content" value="0">
          </div>
        </td>
        <td style="width: 50px" id="progress_database_persen">0 %</td>
      </tr>
    </table>  
  </div>
  <div class="modal-body modal-body-2" style="height: 350px; overflow-y: auto;">       
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-striped table-hover">
        <thead>
          <tr style="background: #e6f0ff">
            <th colspan="6">FILE</th>
          </tr>
          <tr>           
            <th style="text-align: center; width: 100px">No</th>
            <th style="text-align: center;">Filename</th>
            <th style="text-align: center;">Direktori</th>
            <th style="text-align: center;">Date Modified</th>
            <th style="text-align: center;">Response</th>
          </tr>
        </thead>
        <tbody id="data_content">         
        </tbody>
      </table>
      <table class="table table-sm table-bordered table-striped table-hover">
        <thead>
          <tr style="background: #e6f0ff">
            <th colspan="3">DATABASE</th>
          </tr>
          <tr>           
            <th style="text-align: center; width: 100px">No</th>
            <th style="text-align: center;">Query</th>
            <th style="text-align: center;">Response</th>
          </tr>
        </thead>
        <tbody id="data_database">         
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" class="close"><i class="fas fa-times"></i> Batal</button>
  </div>
</div>