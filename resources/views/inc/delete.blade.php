<div class="modal fade" id="delete{{ $object->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" data-dismiss="modal" class="close"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus "{{ $object->nama }}"?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Hapus</button>
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Tidak</button>
            </div>
        </div>
    </div>
</div>