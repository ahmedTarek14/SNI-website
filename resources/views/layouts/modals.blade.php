<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content text-center" id="delete-form" method="post">
            @csrf
            @method('delete')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
            </div>
            <div class="modal-footer text-center">
                <button type="submit" class="custom-btn red-bc">
                    <i class="fa fa-trash"></i> delete
                </button>
                <button type="button" class="custom-btn" data-dismiss="modal">
                    <i class="fa fa-times"></i>close
                </button>
            </div>
        </form>
    </div>
</div>
