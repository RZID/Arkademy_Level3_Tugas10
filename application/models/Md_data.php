<?php
class Md_data extends CI_Model

{
    function rupiahisasi($rupiah)
    {
        return "Rp. " . number_format($rupiah, 0, ".", ".");
    }
    public function filter($search, $limit, $start, $order_field, $order_ascdesc)
    {
        $this->db->like('nama_produk', $search);
        $this->db->or_like('keterangan', $search);
        $this->db->or_like('jumlah', $search);
        $this->db->or_like('harga', $search);
        $this->db->order_by($order_field, $order_ascdesc);
        $this->db->limit($limit, $start);
        $data = $this->db->get('produk')->result_array();
        return $data;
    }
    public function count_all()
    {
        return $this->db->count_all('produk');
    }
    public function count_filter($search)
    {
        $this->db->like('nama_produk', $search);
        $this->db->or_like('keterangan', $search);
        $this->db->or_like('jumlah', $search);
        $this->db->or_like('harga', $search);
        return $this->db->get('produk')->num_rows();
    }
}
