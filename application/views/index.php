<style>
	html,
	body {
		height: 100%;
	}

	@media only screen and(max-height:768px) {
		.display {
			overflow-x: visible;
		}
	}
</style>

<body style="background-color: #30475e;">

	<!-- Image and text -->
	<nav class="navbar navbar-light sticky-top" style="background-color: #e8e8e8;">
		<a class="navbar-brand">
			<img src="https://avatars1.githubusercontent.com/u/47971794?s=280&v=4" style="max-height: 5vh;" alt="" loading="lazy">
			Arkademy CRUD Level 3 - Tugas 10
		</a>
	</nav>

	<div class="container-fluid py-3 h-100">
		<div class="container py-3">
			<div class="shadow p-4 bg-dark text-white rounded">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<div class="text-left">
								<h2>Tabel Produk</h2>
							</div>
						</div>
						<div class="col-md">
							<div class="text-right">
								<button class="btn btn-success" onclick="modalAddData()"><i class="fa fa-plus-circle"></i> Tambah Data</button>
							</div>
						</div>
					</div>
				</div>
				<div class="rounded bg-white text-dark m-4 p-4">
					<table id="table" class="display nowrap" cellspacing="0" style="width:100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Produk</th>
								<th>Keterangan</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Ubah</th>
							</tr>
						</thead>
						<tbody>

						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>