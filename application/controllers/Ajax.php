<?php
class Ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("md_data");
    }

    function datatableFetch()
    {
        $search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
        $limit = $_POST['length']; // Ambil data limit per page
        $start = $_POST['start']; // Ambil data start
        $order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
        $order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
        $sql_total = $this->md_data->count_all(); // Panggil fungsi count_all pada md_data
        $sql_data = $this->md_data->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada md_data
        $sql_filter = $this->md_data->count_filter($search); // Panggil fungsi count_filter pada md_data
        $callback = array(
            'draw' => $_POST['draw'], // Ini dari datatablenya
            'recordsTotal' => $sql_total,
            'recordsFiltered' => $sql_filter,
            'data' => $sql_data
        );
        header('Content-Type: application/json');
        echo json_encode($callback); // Convert array $callback ke json
    }
    function addData()
    {
        $data = [
            "nama_produk" => $this->input->post("nama_produk"),
            "keterangan" => $this->input->post("keterangan"),
            "harga" => $this->input->post("harga"),
            "jumlah" => $this->input->post("jml")
        ];
        $input = $this->db->insert("produk", $data);
        return $input;
    }
    function delData()
    {
        $data = $this->input->post("id");

        $delete = $this->db->delete("produk", ["id" => $data]);
        return $delete;
    }
    function editData()
    {
        $data = [
            "nama_produk" => $this->input->post("nama_produk"),
            "keterangan" => $this->input->post("keterangan"),
            "harga" => $this->input->post("harga"),
            "jumlah" => $this->input->post("jml"),
        ];
        $id = $this->input->post("id");

        $this->db->set($data);
        $this->db->where("id", $id);
        $valedit = $this->db->update("produk");
        return $valedit;
    }
}
