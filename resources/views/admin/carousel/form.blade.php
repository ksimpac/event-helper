<div class="form-group">
    <label for="image">活動縮圖</label>
    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
    <small id="imageHelp" class="form-text text-muted">大小為1999x664</small>
    @error('image')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
