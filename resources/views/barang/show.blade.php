<div class="modal fade" tabindex="-1" role="dialog" id="modal_detail_barang">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content shadow-lg">
      
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">
          <i class="fas fa-box"></i> Detail Data Barang
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form>
        <div class="modal-body">
          <input type="hidden" id="barang_id">

          <div class="row">
            
            <!-- Gambar -->
            <div class="col-md-5 text-center">
              <label class="font-weight-bold">Gambar Barang</label>
              <div class="border rounded p-2">
                <img src="" 
                     id="detail_gambar_preview" 
                     class="img-fluid rounded"
                     style="max-height:250px;">
              </div>
            </div>

            <!-- Detail -->
            <div class="col-md-7">

              <div class="form-group">
                <label>Nama Barang</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                  </div>
                  <input type="text" class="form-control" id="detail_nama_barang" disabled>
                </div>
              </div>

              <div class="form-group">
                <label>Jenis Barang</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                  </div>
                  <select class="form-control" id="detail_jenis_id" disabled>
                    @foreach ($jenis_barangs as $jenis)
                      <option value="{{ $jenis->id }}">{{ $jenis->jenis_barang }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label>Satuan Barang</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                  </div>
                  <select class="form-control" id="detail_satuan_id" disabled>
                    @foreach ($satuans as $satuan)
                      <option value="{{ $satuan->id }}">{{ $satuan->satuan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label>Stok Saat Ini</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                  </div>
                  <input type="text" class="form-control" id="detail_stok" disabled>
                </div>
              </div>

              <div class="form-group">
                <label>Stok Minimum</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-exclamation-triangle"></i></span>
                  </div>
                  <input type="number" class="form-control" id="detail_stok_minimum" disabled>
                </div>
              </div>

              <div class="form-group">
                <label>Deskripsi</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                  </div>
                  <textarea class="form-control" id="detail_deskripsi" rows="3" disabled></textarea>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="modal-footer bg-primary">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i> Tutup
          </button>
        </div>

      </form>

    </div>
  </div>
</div>