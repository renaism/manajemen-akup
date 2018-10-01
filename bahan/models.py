from django.db import models

# Create your models here.
class Bahan(models.Model):
    nama_bahan = models.CharField(max_length=200)
    satuan = models.CharField(max_length=50)
    stok = models.DecimalField()