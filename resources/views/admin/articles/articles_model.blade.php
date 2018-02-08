<div id="articlesModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="post" id="article_form">
				<div class="modal-header">
					<h5 class="modal-title">Create New Article</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>

				</div>
				<div class="modal-body">
					{{csrf_field()}}
					<span id="form_output"></span>
					<div class="form-group">
						<label>Enter Title</label>
						<input type="text" name="title" id="title" class="form-control">
					</div>
                    <div class="form-group">
						<label>Body</label>
						<textarea name="body" id="body" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="article_id" id="article_id" value="">
					<input type="hidden" name="button_action" id="button_action" value="insert">
					<input type="submit" name="submit" id="action" value="Add" class="btn btn-success">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>