<div class="modal fade" id="images-picker-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Insert an Image</h3>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row" id="images-picker">
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script id="entry-template" type="text/x-handlebars-template">
    {{#each images}}
        <div class="col-md-3">
            <div class="thumbnail">
                <div style="min-height: 100px;">
                    <img src="{{image_thumb_url}}" class="img-responsive center-block" style="vertical-align: middle;">
                </div>
                <div class="caption">
                    <p>
                        <span class="pull-right">
                            {{#unless image_active}}
                                <span class="label label-danger">INACTIVE</span>
                            {{/unless}}
                        </span>
                        <strong>{{image_filename}}</strong>
                    </p>
                    <p>
                        <button type="button" class="btn btn-primary insert-image-button" data-url="{{image_url}}">Insert</button>
                    </p>
                </div>
            </div>
        </div>
    {{/each}}
</script>

<script id="images-query-url" type="text/x-bryans-variable">
    <?php echo_global_url('admin/images.json'); ?>
</script>