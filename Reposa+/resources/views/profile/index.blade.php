@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                    <p class="text-muted small">{{ $user->email }}</p>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#overview" class="list-group-item list-group-item-action border-0 px-0 active"><i class="bi bi-person me-2"></i> Mi Perfil</a>
                    <a href="#orders" class="list-group-item list-group-item-action border-0 px-0"><i class="bi bi-box me-2"></i> Mis Pedidos</a>
                    <a href="#addresses" class="list-group-item list-group-item-action border-0 px-0"><i class="bi bi-geo-alt me-2"></i> Mis Direcciones</a>
                    <a href="#favorites" class="list-group-item list-group-item-action border-0 px-0"><i class="bi bi-heart me-2"></i> Favoritos</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Overview Section -->
            <div id="overview" class="mb-5">
                <div class="card border-0 shadow-sm rounded-4 p-5">
                    <h4 class="fw-bold mb-4">Datos Personales</h4>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Nombre Completo</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Correo Electrónico</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Teléfono</label>
                                <input type="text" class="form-control" value="{{ $user->profile->phone ?? 'No especificado' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Preferencia de Sueño</label>
                                <input type="text" class="form-control" value="{{ $user->profile->sleep_preference ?? 'No especificada' }}" readonly>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary mt-4">Editar Perfil</button>
                    </form>
                </div>
            </div>

            <!-- Orders Section -->
            <div id="orders" class="mb-5">
                <div class="card border-0 shadow-sm rounded-4 p-5">
                    <h4 class="fw-bold mb-4">Mis Pedidos Recientes</h4>
                    @if($user->orders->isEmpty())
                        <div class="text-center py-4">
                            <i class="bi bi-bag-x fs-1 text-muted"></i>
                            <p class="mt-3">Aún no has realizado ningún pedido.</p>
                            <a href="/catalog" class="btn btn-primary">Ir a la tienda</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>ID Pedido</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->orders as $order)
                                        <tr>
                                            <td class="fw-bold">#{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                            <td>{{ number_format($order->total_amount, 2) }}€</td>
                                            <td>
                                                <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : 'warning' }} px-3 py-2">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-outline-secondary">Ver detalles</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Addresses Section -->
            <div id="addresses">
                <div class="card border-0 shadow-sm rounded-4 p-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Mis Direcciones de Envío</h4>
                        <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i> Nueva Dirección</button>
                    </div>
                    @if($user->addresses->isEmpty())
                        <div class="text-center py-4">
                            <i class="bi bi-geo fs-1 text-muted"></i>
                            <p class="mt-3">No tienes direcciones registradas.</p>
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach($user->addresses as $address)
                                <div class="col-md-6">
                                    <div class="border rounded-4 p-4 position-relative">
                                        @if($address->is_main)
                                            <span class="badge bg-secondary position-absolute top-0 end-0 m-3">Principal</span>
                                        @endif
                                        <h6 class="fw-bold">{{ $address->street }}</h6>
                                        <p class="text-muted small mb-0">{{ $address->zip_code }} - {{ $address->city }}</p>
                                        <div class="mt-3">
                                            <a href="#" class="small text-decoration-none me-3">Editar</a>
                                            <a href="#" class="small text-danger text-decoration-none">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
