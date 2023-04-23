@extends('layouts.portal.master')
@section('content')

@include('layouts.components.alerts')
<div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          Nowych aplikacji
        </div>
        <div class="card-body">
          <h1>24</h1>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
          <a href="#" class="btn btn-primary">
            Primary
          </a>
          <a href="#" class="btn btn-outline-primary">
            Primary
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-3">

    </div>
    <div class="col-md-3">

    </div>
</div>
<div class="row my-4">
<div class="col-md-6">
  <table class="table align-middle mb-0 bg-white pmc-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Status</th>
        <th>Position</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <div class="d-flex align-items-center">
            <img
                src="https://mdbootstrap.com/img/new/avatars/8.jpg"
                alt=""
                style="width: 45px; height: 45px"
                class="rounded-circle"
                />
            <div class="ms-3">
              <p class="fw-bold mb-1">John Doe</p>
              <p class="text-muted mb-0">john.doe@gmail.com</p>
            </div>
          </div>
        </td>
        <td>
          <p class="fw-normal mb-1">Software engineer</p>
          <p class="text-muted mb-0">IT department</p>
        </td>
        <td>
          <span class="badge badge-success rounded-pill d-inline">Active</span>
        </td>
        <td>Senior</td>
        <td>
          <button type="button" class="btn btn-link btn-sm btn-rounded">
            Edit
          </button>
        </td>
      </tr>
      <tr>
        <td>
          <div class="d-flex align-items-center">
            <img
                src="https://mdbootstrap.com/img/new/avatars/6.jpg"
                class="rounded-circle"
                alt=""
                style="width: 45px; height: 45px"
                />
            <div class="ms-3">
              <p class="fw-bold mb-1">Alex Ray</p>
              <p class="text-muted mb-0">alex.ray@gmail.com</p>
            </div>
          </div>
        </td>
        <td>
          <p class="fw-normal mb-1">Consultant</p>
          <p class="text-muted mb-0">Finance</p>
        </td>
        <td>
          <span class="badge badge-primary rounded-pill d-inline"
                >Onboarding</span
            >
        </td>
        <td>Junior</td>
        <td>
          <button
                  type="button"
                  class="btn btn-link btn-rounded btn-sm fw-bold"
                  data-mdb-ripple-color="dark"
                  >
            Edit
          </button>
        </td>
      </tr>
      <tr>
        <td>
          <div class="d-flex align-items-center">
            <img
                src="https://mdbootstrap.com/img/new/avatars/7.jpg"
                class="rounded-circle"
                alt=""
                style="width: 45px; height: 45px"
                />
            <div class="ms-3">
              <p class="fw-bold mb-1">Kate Hunington</p>
              <p class="text-muted mb-0">kate.hunington@gmail.com</p>
            </div>
          </div>
        </td>
        <td>
          <p class="fw-normal mb-1">Designer</p>
          <p class="text-muted mb-0">UI/UX</p>
        </td>
        <td>
          <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
        </td>
        <td>Senior</td>
        <td>
          <button
                  type="button"
                  class="btn btn-link btn-rounded btn-sm fw-bold"
                  data-mdb-ripple-color="dark"
                  >
            Edit
          </button>
        </td>
      </tr>
    </tbody>
  </table>
  <select class="select form-control">
    <option>One</option>
    <option>Two</option>
  </select>

  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Example label</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Example label</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


</div>
</div>
@endsection