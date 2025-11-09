# Instrucciones para Agregar Imágenes Reales de Barrancabermeja

## Problema Actual
Las imágenes actuales en el carrusel son genéricas y no son específicas de Barrancabermeja.

## Solución: Descargar Imágenes Reales

### Opción 1: Descargar desde Tripadvisor
1. Visita: https://www.tripadvisor.co/LocationPhotos-g1594789-Barrancabermeja_Santander_Department.html
2. Haz clic derecho en las imágenes que te gusten
3. Selecciona "Guardar imagen como..."
4. Guarda las imágenes en: `public/images/barrancabermeja/`
5. Nombra las imágenes como: `barrancabermeja-real-1.jpg`, `barrancabermeja-real-2.jpg`, etc.

### Opción 2: Descargar desde Wikimedia Commons
1. Visita: https://commons.wikimedia.org/wiki/Category:Barrancabermeja
2. Busca imágenes de Barrancabermeja
3. Haz clic en "Descargar" o "Original file"
4. Guarda las imágenes en: `public/images/barrancabermeja/`

### Opción 3: Descargar desde Pixabay
1. Visita: https://pixabay.com/es/images/search/imagen%20de%20barrancabermeja/
2. Busca imágenes de Barrancabermeja
3. Descarga las imágenes gratuitas
4. Guarda en: `public/images/barrancabermeja/`

### Opción 4: Usar tus propias fotos
Si tienes fotos propias de Barrancabermeja:
1. Redimensiona las imágenes a aproximadamente 1920x1080px (o similar)
2. Optimiza las imágenes para web (reduce el tamaño del archivo)
3. Guarda en: `public/images/barrancabermeja/`

## Después de Descargar

Una vez que tengas las imágenes reales:

1. **Reemplaza las imágenes actuales** en la carpeta `public/images/barrancabermeja/`
   - Puedes mantener los mismos nombres de archivo
   - O actualizar las rutas en el archivo `resources/views/businesses.blade.php`

2. **Actualiza el carrusel** si usas nombres diferentes:
   - Abre: `resources/views/businesses.blade.php`
   - Busca la sección del carrusel (línea ~769)
   - Actualiza las rutas de las imágenes

## Imágenes Recomendadas para el Carrusel

Para un carrusel representativo, busca:
- Vista aérea de Barrancabermeja
- Río Magdalena
- Puente Guillermo Gaviria
- Cristo Petrolero
- Parroquia de La Inmaculada
- Atardecer en Barrancabermeja
- Puerto de Barrancabermeja

## Nota sobre Derechos de Autor

Asegúrate de que las imágenes que descargues tengan licencia para uso comercial o sean de dominio público.

