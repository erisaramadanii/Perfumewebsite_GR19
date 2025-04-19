<?php 
class Parfum{
  public $emri;
  public $foto;
  public $cmimi;
  public $gjinia;

  public function__construct($emri, $cmimi, $gjinia) {
  $this->emri = $emri;
  $this->foto = $foto;
  $this->cmimi = $cmimi;
  $this->gjinia = $gjinia;
}
}
$parfumet = [
  new Parfum(emri: "Classique", foto: "F1_Classique.jpg", cmimi: 55, gjinia: "female"),
  new Parfum(emri: "Scandal", foto: "F1_Scandal.jpg", cmimi: 70, gjinia: "female"),
  new Parfum(emri: "La Belle", foto: "F1_La_Belle.webp.jpg", cmimi: 68, gjinia: "female"),
new Parfum(emri: "So Scandal", foto: "F1_So_Scandal.jpg", cmimi: 78, gjinia: "female"),
  new Parfum(emri: "La Male", foto: "M5_La_Male.jpg", cmimi: 60, gjinia: "male"),
  new Parfum(emri: "La Male Le Parfum", foto: "M2_La_Male_Le_Parfum.jpg", cmimi: 75, gjinia: "male"),
   new Parfum("La Beau", "M3_La_Beau.webp", 65, "male"),
    new Parfum("Ultra Male", "M4_Ultra_Male.jpg", 80, "male"),
];

$gjinia = isset($_GET['gjinia']) ? $_GET['gjinia'] : null;
$sort = $_GET['sort'] ?? null;
$gjiniaArray = is_array($gjinia) ? $gjinia : explode(',', $gjinia);

if ($gjinia) {
    $parfumet = array_filter($parfumet, fn($p) => in_array($p->gjinia, $gjiniaArray));
}

if ($sort === "asc") {
    usort($parfumet, fn($a, $b) => $a->cmimi <=> $b->cmimi);
} elseif ($sort === "desc") {
    usort($parfumet, fn($a, $b) => $b->cmimi <=> $a->cmimi);
}
?>
