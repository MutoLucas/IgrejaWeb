<div>
    @if($dado == null || $endereco == null || $devocao == null || $escolaridade == null)
    <button class="btn btn-sm text-light" type="button" data-bs-toggle="modal" data-bs-target="#modalMessage"><i class="bi bi-envelope-exclamation-fill"></i></button>

    <div class="modal fade" id="modalMessage" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header bg bg-dark text-light text-center">
                    <h3>Mensagens</h3>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <a href="{{ route('edit.index', auth()->user()->id) }}" class="list-group-item"><i class="bi bi-envelope-paper"></i> Pendência de preenchimento</a>
                      </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
