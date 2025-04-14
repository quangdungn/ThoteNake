<!-- Modal Xác Nhận Xóa -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="deleteForm" method="POST" action="">
           @csrf
           @method('DELETE')
           <div class="modal-header">
               <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận xóa</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               Bạn có chắc chắn muốn xóa mục này không?
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
               <button type="submit" class="btn btn-danger">Xóa</button>
           </div>
        </form>
      </div>
    </div>
  </div>
  