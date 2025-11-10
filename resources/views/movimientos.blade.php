@extends('layouts.app')

@section('titulo', 'Entradas y Salidas')

@section('contenido')
<div class="container-fluid">
  <div class="text-left"> <div class="row">

      <div class="col-lg-6">
        <div class="card card-success card-outline">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-arrow-up text-success"></i> Registrar Entrada</h3>
          </div>
          <div class="card-body">
            @if(session('success_entrada'))
              <div class="alert alert-success">{{ session('success_entrada') }}</div>
            @endif

            <form action="{{ route('movimientos.entrada') }}" method="POST" enctype="multipart/form-data">
              @csrf
              
              <div class="form-group">
                <label for="desc_entrada">Tipo de Entrada (Descripción)</label>
                <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="desc_entrada" placeholder="Ej: Salario, Venta, etc." value="{{ old('descripcion') }}" required>
                @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              
              <div class="form-group">
                <label for="monto_entrada">Monto</label>
                <input type="number" step="0.01" name="monto" class="form-control @error('monto') is-invalid @enderror" id="monto_entrada" placeholder="0.00" value="{{ old('monto') }}" required>
                @error('monto') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              
              <div class="form-group">
                <label for="fecha_entrada">Fecha</label>
                <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror" id="fecha_entrada" value="{{ old('fecha', date('Y-m-d')) }}" required>
                @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="form-group">
                <label for="factura_entrada">Factura (Foto)</label>
                <input type="file" name="factura" class="form-control-file @error('factura') is-invalid @enderror" id="factura_entrada">
                @error('factura') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <button type="submit" class="btn btn-success float-right">Registrar Entrada</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card card-danger card-outline">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-arrow-down text-danger"></i> Registrar Salida</h3>
          </div>
          <div class="card-body">
            @if(session('success_salida'))
              <div class="alert alert-success">{{ session('success_salida') }}</div>
            @endif

            <form action="{{ route('movimientos.salida') }}" method="POST" enctype="multipart/form-data">
              @csrf
              
              <div class="form-group">
                <label for="desc_salida">Tipo de Salida (Descripción)</label>
                <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="desc_salida" placeholder="Ej: Alquiler, Comida, etc." value="{{ old('descripcion') }}" required>
                @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              
              <div class="form-group">
                <label for="monto_salida">Monto de Salida</label>
                <input type="number" step="0.01" name="monto" class="form-control @error('monto') is-invalid @enderror" id="monto_salida" placeholder="0.00" value="{{ old('monto') }}" required>
                @error('monto') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              
              <div class="form-group">
                <label for="fecha_salida">Fecha de Salida</label>
                <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror" id="fecha_salida" value="{{ old('fecha', date('Y-m-d')) }}" required>
                @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="form-group">
                <label for="factura_salida">Factura de Salida</label>
                <input type="file" name="factura" class="form-control-file @error('factura') is-invalid @enderror" id="factura_salida">
                @error('factura') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <button type="submit" class="btn btn-danger float-right">Registrar Salida</button>
            </form>
          </div>
        </div>
      </div>

    </div>

    <div class="row mt-4">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Historial de Entradas</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Descripción</th>
                  <th>Monto</th>
                  <th>Fecha</th>
                  <th>Factura</th>
                  <th>Registro</th>
                </tr>
              </thead>
              <tbody>
                @forelse($entradas as $mov)
                <tr>
                  <td>{{ $mov->descripcion }}</td>
                  <td class="text-success font-weight-bold">+ $ {{ number_format($mov->monto, 2) }}</td>
                  <td>{{ \Carbon\Carbon::parse($mov->fecha)->format('d/m/Y') }}</td>
                  <td>
                    @if($mov->factura_url)
                      <a href="{{ Storage::url($mov->factura_url) }}" target="_blank">
                        <img src="{{ Storage::url($mov->factura_url) }}" alt="Factura" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                      </a>
                    @else
                      <span class="text-muted">N/A</span>
                    @endif
                  </td>
                  <td>{{ \Carbon\Carbon::parse($mov->fecha_registro)->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">No hay entradas registradas.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Historial de Salidas</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Descripción</th>
                  <th>Monto</th>
                  <th>Fecha</th>
                  <th>Factura</th>
                  <th>Registro</th>
                </tr>
              </thead>
              <tbody>
                @forelse($salidas as $mov)
                <tr>
                  <td>{{ $mov->descripcion }}</td>
                  <td class="text-danger font-weight-bold">- $ {{ number_format($mov->monto, 2) }}</td>
                  <td>{{ \Carbon\Carbon::parse($mov->fecha)->format('d/m/Y') }}</td>
                  <td>
                    @if($mov->factura_url)
                      <a href="{{ Storage::url($mov->factura_url) }}" target="_blank">
                        <img src="{{ Storage::url($mov->factura_url) }}" alt="Factura" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                      </a>
                    @else
                      <span class="text-muted">N/A</span>
                    @endif
                  </td>
                  <td>{{ \Carbon\Carbon::parse($mov->fecha_registro)->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">No hay salidas registradas.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
@endsection