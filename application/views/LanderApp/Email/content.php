<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-sm-6" id="tampil-box">
<form action="<?=base_url()?>Admin/saveTemplateEmail" class="panel form-horizontal" method="post" enctype="multipart/form-data" >
	<div class="panel-heading">
		<span class="panel-title"><?=$title?> Baru</span>
	</div>
	<div class="panel-body">
		<?php if($error=$this->session->flashdata('error')){ ?>
		<div class="alert alert-danger alert-dark">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong><i class="fa fa-bell faa-ring animated"></i></strong> &nbsp;<span><?=$error?></span>
		</div>
		<?php }
		if($success=$this->session->flashdata('success')){ ?>
		<div class="alert alert-success alert-dark">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong><i class="fa fa-bell faa-ring animated"></i></strong> &nbsp;<span><?=$success?></span>
		</div>
		<?php }?>
		<div class="row form-group">
			<label class="col-sm-3 control-label">Email <font color="red">*</font> :</label>
			<div class="col-sm-9">
				<input type="text" name="name" class="form-control" placeholder="Email Name" autocomplete="off">
			</div>
		</div>
		<div class="row form-group">
			<label class="col-sm-3 control-label">Subject <font color="red">*</font> :</label>
			<div class="col-sm-9">
				<input type="text" name="subject" class="form-control" placeholder="Subjek Email" autocomplete="off">
			</div>
		</div>

		<textarea class="form-control summernote-example" name="message" rows="10">Tulis Email...</textarea>
	</div>
	<div class="panel-footer text-center">
		<button class="btn btn-success btn-rounded faa-parent animated-hover" data-toggle="tooltip" data-placement="top" title="" data-original-title="Simpan <?=$title?> Baru" onclick="btnSave()"><i class="fa fa-plus faa-vertical"></i> Simpan</button>
	</div>
</form>
</div>
<div class="col-sm-6">
<div class="panel">
	<div class="panel-body">
		<div class="table-Light">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="datatables">
				<thead>
					<tr>
						<th>No</th>
						<th>Subject</th>
						<th>Status</th>
						<th class="text-center">Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($allData->result() as $row){ ?>
					<tr class="odd gradeX">
						<td><?=$no?></td>
						<td><?=$row->subject?></td>
						<td class="text-center">
							<?php if($row->is_active==1){ ?>
								<a href="<?=base_url().'Admin/statusEmail/'.$row->email_id.'/0'?>" class="label label-info">Aktif</a>
							<?php }else{ ?>
								<a href="<?=base_url().'Admin/statusEmail/'.$row->email_id.'/1'?>"class="label label-danger">Nonaktif</a>
							<?php }?>
						</td>
						<td class="text-center" style="width: 30%;">
							<button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail <?=$row->subject?>" onclick="loadEdit(<?=$row->email_id?>,'detail')"><i class="fa fa-eye faa-vertical"></i></button>
							<a href="<?=base_url().'Admin/updateEmail/'.$row->email_id?>" class="btn btn-success btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit <?=$row->subject?>"><i class="fa fa-edit faa-vertical"></i></button>							
						</td>
					</tr>
				<?php $no++; }?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="panel-footer">
		<div class="text-center">Keterangan : 
			<button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-loading-text="Loading..." data-original-title="Detail Data"><i class="fa fa-eye faa-vertical"></i> Detail Data</button>
			<button class="btn btn-success btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data"><i class="fa fa-edit faa-vertical"></i> Edit Data</button>
		</div>
	</div>
</div>
</div>
<script>
	function loadEdit(id,action){
		$.ajax({
          type:"POST",
          url:"<?=base_url()?>EmailCTRL/loadData",
          data:{id:id, action:action},
          cache:false,
          success:function(a){
            $('#tampil-box').html(a);
          }
        });
	}
</script>
<script>
	init.push(function () {
		$('.datatables').dataTable();
		$('#datatables_wrapper .table-caption').text('Data Email');
		$('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
	});
</script>
<script>
	init.push(function () {
		if (! $('html').hasClass('ie8')) {
			$('.summernote-example').summernote({
				height: 350,
				tabsize: 2,
				codemirror: {
					theme: 'monokai'
				}
			});
		}
	});
</script>