<!-- Modal -->
<div class="modal fade" id="modal-update-cate-blog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form role="form" method="POST" id="form-edit-category-blog">
                @csrf
                <div class="modal-header no-bd">
                    <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Cập nhật</span>
                        <span class="fw-light text-uppercase">
                                        Danh mục blog
                                    </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="error-message"
                                  style="color:red;">{{ $errors->first('name_cate') }}</span>
                            <div class="form-group form-group-default">
                                <label for="name_cate">Tên danh mục</label>
                                <input type="text" id="name_cate_edit" class="form-control" name="name_cate"
                                       placeholder="Nhập tên danh mục ...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="btn-update-cate-blog" class="btn btn-primary">Cập nhật
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy bỏ</button>
                </div>
            </form>
        </div>
    </div>
</div>

