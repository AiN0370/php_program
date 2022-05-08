@props(['listing'])
@props(['users'])

<div class="card mt-3" style="max-width: 1000px;margin: auto;">
  <div class="card-body d-flex flex-row">
      <a href="#" class="text-dark">
          <i class="fas fa-user-circle fa-3x mr-1"></i>
      </a>
      <div>
          <div class="font-weight-bold">
              <a href="/?userId={{$listing->user_id}}" class="text-dark">
                  {{$users->find($listing['user_id'])->name}}
              </a>
          </div>
          <div class="font-weight-lighter">
              {{$listing->created_at}}
          </div>
      </div>

      <!-- dropdown -->
      <div class="ml-auto card-text">
          <div class="dropdown">
              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <button type="button" class="btn btn-link text-muted m-0 p-2">
                      <i class="fas fa-ellipsis-v"></i>
                  </button>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="/listings/{{$listing->id}}/edit">
                      <i class="fas fa-pen mr-1"></i>記事を更新する
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" data-toggle="modal"
                  data-target="#modal-delete-id">
                      <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                  </a>
              </div>
          </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-id" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form method="POST" action="/listings/{{$listing->id}}">
                    @csrf
                    @method('DELETE')
                      <div class="modal-body">
                          タイトルを削除します。よろしいですか？
                      </div>
                      <div class="modal-footer justify-content-between">
                          <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                          <button type="submit" class="btn btn-danger">削除する</button>
                      </div>
                  </form>

              </div>
          </div>
      </div>
      <!-- modal -->
      
  </div>
  <div class="card-body pt-0 pb-2">
      <h3 class="h4 card-title">
          <a class="text-dark" href="/listings/{{$listing->id}}">
              {{$listing->title}}
          </a>
      </h3>
  </div>
</div>
<!-- カード部分　ここまでを繰り返し -->