<div id="articlesModel" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="post" id="article_form" data-toggle="validator" enctype="multipart/form-data">
				<div class="modal-header">
					<h5 class="modal-title">Create New Article</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>

				</div>
				<div class="modal-body">
					{{csrf_field()}}
					<span id="form_output"></span>
					<div class="form-group">
						<label>Enter Title</label>
						<input type="text" name="title" id="title" class="form-control" data-error="Please enter article title."  required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="row">
	                  <div class="col-md-4">
	                   <div class="form-group">
	                     <label for="category_id"> Category</label>
	                     <select class="form-control" name="category_id" id="category_id">
	                       
	                      </select>
	                     </div>
	                   </div>
	                 </div>

                    <div class="form-group">
						<label>Body</label>
						<textarea name="body" id="body" class="form-control" data-error="Please enter article body."  required></textarea>
						 <div class="help-block with-errors"></div>
					</div>
					  <img id="current_image" style="width:100%" src="">

					<div class="form-group">
                          <input type="file" name="cover_image" id="cover_image" class="filestyle" data-buttonBefore="true" data-size="sm" data-placeholder="No file" data-buttonName="btn-primary" data-buttonText="Cover Image" data-icon="false" data-error="Please select image to the article."  >                         
                   </div>
                    <div class="form-group">
						<label>Tags</label>
                        <input type="text" class="form-control" id="tags" />
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