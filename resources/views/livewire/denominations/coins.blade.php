<div class="container-fluid">
    <div class="row sales layouts-top-spacing">
        <div class="col-sm-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 text-primary">{{$componentName}}|{{$pageTitle}}</h6>
                    <div class="dropdown no-arrow">
                        <a class="btn btn-success btn-sm" href="javascript:void(0)" role="button" data-toggle="modal" data-target="#theModal"> 
                            Agregar
                            <i class="fas fa-plus fa-sm fa-fw text-gray-400"></i>
                        </a>                        
                    </div>
                </div>
                <div class="card-body">
                    @include('common.searchbox')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background: #003471">
                                <tr>
                                    <th class="table-th text-white">TIPO</th>
                                    <th class="table-th text-white">VALOR</th>
                                    <th class="table-th text-white">IMAGEN</th>
                                    <th class="table-th text-white">ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $coins)
                                    <tr>
                                        <td>{{$coins->type}}</td>
                                        <td>Bs. {{ number_format($coins->value,2)}}</td>
                                        <td class="text-center">
                                            <span>
                                                <img src="{{ asset('storage/denominaciones/' . $coins->imagen) }}" alt="" heigth="70" width="80" class="rounded">
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" wire:click="Edit({{$coins->id}})" class="btn btn-info btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" onclick="Confirm('{{$coins->id}}')" class="btn btn-danger btn-sm" title="Borrar">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$data->links()}}
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    @include('livewire.denominations.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        //para escuchar eventos
        window.livewire.on('show-modal',msg => {
            $('#theModal').modal('show');
        });
        window.livewire.on('hide-modal',msg => {
            $('#theModal').modal('hide');
        });
        window.livewire.on('denomination-added',msg => {
            $('#theModal').modal('hide');
        });
        window.livewire.on('denomination-updated',msg => {
            $('#theModal').modal('hide');
        });
        window.livewire.on('denomination-deleted',msg => {
            
        });
        $('#theModal').on('hidden.bs.modal',msg => {
            $('.er').css('display','none')
        });
    });
    function Confirm(id,products){
        if(products > 0){
            Swal.fire('NO SE PUEDE ELIMINAR LA CATEGORIA PORQUE TIENE PRODUCTOS RELACIONADOS')
            return;
        }
        Swal.fire({
            title: 'Confirmar',
            text: 'Confirmas Eliminar el Registro',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'CERRAR',
            CancelButtonColor: '#fff',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Aceptar'
        }).then(function(result){
            if(result.value){
                window.livewire.emit('deleteRow', id);
                swal.close();
            }
        });
    }
</script>