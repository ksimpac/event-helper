<div class="form-group">
  <label for="indexImage">活動縮圖</label>
  <input type="file" class="form-control-file @error('indexImage') is-invalid @enderror" id="indexImage" name="indexImage" value="{{ old('indexImage') }}">
  <small id="indexImageHelp" class="form-text text-muted">預設大小為300x107，非300x107比例的圖片系統將強制調整，圖檔大小限制1MB以下</small>
  @error('indexImage')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="title">活動標題</label>
  <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') ?? $event->title ?? '' }}">
  <small id="titleHelp" class="form-text text-muted">字元限制：100字元</small>
  @error('title')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="slogan">活動標語</label>
  <input type="text" class="form-control @error('slogan') is-invalid @enderror" id="slogan" name="slogan" value="{{ old('slogan') ?? $event->slogan ?? '' }}">
  <small id="sloganHelp" class="form-text text-muted">字元限制：100字元</small>
  @error('slogan')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="location">活動地點</label>
  <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') ?? $event->location ?? ''}}">
  <small id="locationHelp" class="form-text text-muted">字元限制：100字元</small>
  @error('location')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="dateStart">活動開始時間</label>
  <input type="text" class="form-control datetimepicker-input @error('dateStart') is-invalid @enderror" id="dateStart" data-toggle="datetimepicker" name="dateStart" data-target="#dateStart" placeholder="請選擇時間" value="{{ old('dateStart') ?? $event->dateStart ?? ''}}" />
  @error('dateStart')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="dateEnd">活動結束時間</label>
  <input type="text" class="form-control datetimepicker-input @error('dateEnd') is-invalid @enderror" id="dateEnd" data-toggle="datetimepicker" name="dateEnd" data-target="#dateEnd" placeholder="請選擇時間" value="{{ old('dateEnd') ?? $event->dateEnd ?? ''}}"/>
  @error('dateEnd')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="enrollDeadline">報名截止時間</label>
  <input type="text" class="form-control datetimepicker-input @error('enrollDeadline') is-invalid @enderror" id="enrollDeadline" data-toggle="datetimepicker" name="enrollDeadline" data-target="#enrollDeadline" placeholder="請選擇時間" value="{{  old('enrollDeadline') ?? $event->enrollDeadline ?? ''}}"/>
  @error('enrollDeadline')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="maximum">人數限制</label>
  <input type="number" class="form-control @error('maximum') is-invalid @enderror" id="maximum" name="maximum" min="0" value="{{ old('maximum') ?? $event->maximum ?? ''}}"/>
  <small id="maximumHelp" class="form-text text-muted">參加人數無限制請填0</small>
  @error('maximum')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="targets">活動對象（多選）:</label>
  <select multiple class="form-control @error('targets') is-invalid @enderror" id="targets" name="targets[]" size="11">
      @foreach($targets as $key => $target)
          <option value="{{ $target }}" {{ in_array($target, old('targets') ?? $limits ?? []) ? 'selected':'' }}>{{ $target }}</option>
      @endforeach
  </select>
  @error('targets')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="tags">標籤</label>
  <textarea class="form-control" id="tags" name="tags" rows="7">{{ old('tags') ?? (isset($tags) ? implode(" ", $tags) : '')  }}</textarea>
  <small id="tagsHelp" class="form-text text-muted">可自定義標籤或不填入，每個標籤請使用一個Space(空白鍵)分隔</small>
</div>

<div class="form-group">
  <label for="type">活動分類</label>

  <div class="@error('type') is-invalid @enderror">
      @foreach($types as $key => $type)
          <div class="custom-control custom-radio custom-control-inline ml-3">
              <input type="radio" id="{{ "customRadioInline".($key + 1) }}" name="type" class="custom-control-input" value="{{ $type }}" {{ ($event->type ?? old('type')) == $type ? 'checked="checked"': '' }}>
              <label class="custom-control-label" for="{{ "customRadioInline".($key + 1) }}">{{ $type }}</label>
          </div>
      @endforeach
  </div>

  @error('type')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>

<div class="form-group">
  <label for="moreInfo">詳細內容</label>
  <textarea id="moreInfo" name="moreInfo">{{ old('moreInfo') ?? $event->moreInfo ?? ''}}</textarea>
  <small id="indexImageHelp" class="form-text text-muted">圖檔大小限制1MB以下</small>
</div>
