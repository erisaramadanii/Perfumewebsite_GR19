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
  
