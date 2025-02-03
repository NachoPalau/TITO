<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Manzanas',
            'descripcion' => 'Fruta fresca, rica en fibra y vitaminas.',
            'precio' => 1.50,
            'stock' => 100,
            'imagen_url' => 'manzana.jpg',
        ]);

        Producto::create([
            'nombre' => 'Plátanos',
            'descripcion' => 'Fruta tropical rica en potasio y energía.',
            'precio' => 0.80,
            'stock' => 120,
            'imagen_url' => 'platano.jpg',
        ]);

        Producto::create([
            'nombre' => 'Naranjas',
            'descripcion' => 'Cítrico refrescante y lleno de vitamina C.',
            'precio' => 1.20,
            'stock' => 150,
            'imagen_url' => 'naranja.jpg',
        ]);

        Producto::create([
            'nombre' => 'Uvas',
            'descripcion' => 'Fruta dulce y jugosa, excelente para meriendas.',
            'precio' => 2.00,
            'stock' => 200,
            'imagen_url' => 'uva.jpg',
        ]);

        Producto::create([
            'nombre' => 'Fresas',
            'descripcion' => 'Fruta roja y dulce, perfecta para postres.',
            'precio' => 2.50,
            'stock' => 80,
            'imagen_url' => 'fresa.jpg',
        ]);

        Producto::create([
            'nombre' => 'Peras',
            'descripcion' => 'Fruta jugosa y dulce, rica en fibra.',
            'precio' => 1.30,
            'stock' => 90,
            'imagen_url' => 'pera.jpg',
        ]);

        Producto::create([
            'nombre' => 'Mangos',
            'descripcion' => 'Fruta tropical con un sabor dulce y exótico.',
            'precio' => 2.80,
            'stock' => 110,
            'imagen_url' => 'mango.jpg',
        ]);

        Producto::create([
            'nombre' => 'Tomates',
            'descripcion' => 'Verdura roja y jugosa, ideal para ensaladas.',
            'precio' => 1.00,
            'stock' => 200,
            'imagen_url' => 'tomate.jpg',
        ]);

        Producto::create([
            'nombre' => 'Zanahorias',
            'descripcion' => 'Verdura naranja rica en vitamina A.',
            'precio' => 0.90,
            'stock' => 150,
            'imagen_url' => 'zanahoria.jpg',
        ]);

        Producto::create([
            'nombre' => 'Patatas',
            'descripcion' => 'Tubérculo versátil para todo tipo de platos.',
            'precio' => 1.10,
            'stock' => 300,
            'imagen_url' => 'patata.jpg',
        ]);
        Producto::create([
            'nombre' => 'Lechugas',
            'descripcion' => 'Hojas verdes frescas y crujientes, ideales para ensaladas.',
            'precio' => 1.20,
            'stock' => 100,
            'imagen_url' => 'lechuga.jpg',
        ]);

        Producto::create([
            'nombre' => 'Espárragos',
            'descripcion' => 'Verdura rica en fibra y antioxidantes, perfecta para acompañar platos.',
            'precio' => 2.50,
            'stock' => 80,
            'imagen_url' => 'esparrago.jpg',
        ]);

        Producto::create([
            'nombre' => 'Brócoli',
            'descripcion' => 'Verdura verde, rica en vitaminas y minerales, excelente para la salud.',
            'precio' => 1.80,
            'stock' => 150,
            'imagen_url' => 'brocoli.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pepinos',
            'descripcion' => 'Verdura fresca y jugosa, ideal para ensaladas o para comer sola.',
            'precio' => 1.00,
            'stock' => 200,
            'imagen_url' => 'pepino.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pimientos',
            'descripcion' => 'Verdura colorida y sabrosa, rica en vitamina C.',
            'precio' => 1.40,
            'stock' => 120,
            'imagen_url' => 'pimiento.jpg',
        ]);

        Producto::create([
            'nombre' => 'Cebollas',
            'descripcion' => 'Verdura que añade sabor a cualquier plato.',
            'precio' => 0.90,
            'stock' => 180,
            'imagen_url' => 'cebolla.jpg',
        ]);

        Producto::create([
            'nombre' => 'Ajo',
            'descripcion' => 'Ajo fresco, utilizado en muchas recetas por su sabor fuerte.',
            'precio' => 0.50,
            'stock' => 300,
            'imagen_url' => 'ajo.jpg',
        ]);

        Producto::create([
            'nombre' => 'Espinacas',
            'descripcion' => 'Verdura rica en hierro, ideal para ensaladas o cocida.',
            'precio' => 1.60,
            'stock' => 140,
            'imagen_url' => 'espinaca.jpg',
        ]);

        Producto::create([
            'nombre' => 'Calabacines',
            'descripcion' => 'Verdura suave y ligera, ideal para sopas y guisos.',
            'precio' => 1.30,
            'stock' => 130,
            'imagen_url' => 'calabacin.jpg',
        ]);

        Producto::create([
            'nombre' => 'Champiñones',
            'descripcion' => 'Hongo comestible, ideal para salsas, ensaladas y guisos.',
            'precio' => 2.20,
            'stock' => 160,
            'imagen_url' => 'champino.jpg',
        ]);

        Producto::create([
            'nombre' => 'Aguacates',
            'descripcion' => 'Fruta cremosa rica en grasas saludables, ideal para ensaladas.',
            'precio' => 2.80,
            'stock' => 100,
            'imagen_url' => 'aguacate.jpg',
        ]);

        Producto::create([
            'nombre' => 'Piña',
            'descripcion' => 'Fruta tropical dulce y jugosa, perfecta para postres y batidos.',
            'precio' => 2.50,
            'stock' => 90,
            'imagen_url' => 'pina.jpg',
        ]);

        Producto::create([
            'nombre' => 'Sandía',
            'descripcion' => 'Fruta refrescante y dulce, ideal para el verano.',
            'precio' => 3.00,
            'stock' => 70,
            'imagen_url' => 'sandia.jpg',
        ]);

        Producto::create([
            'nombre' => 'Melón',
            'descripcion' => 'Fruta dulce y refrescante, perfecta para ensaladas de frutas.',
            'precio' => 2.80,
            'stock' => 60,
            'imagen_url' => 'melon.jpg',
        ]);

        Producto::create([
            'nombre' => 'Limón',
            'descripcion' => 'Fruta cítrica muy ácida, perfecta para cocinar y beber.',
            'precio' => 0.70,
            'stock' => 300,
            'imagen_url' => 'limon.jpg',
        ]);



        Producto::create([
            'nombre' => 'Pollo (Pechugas, Muslos, Alas)',
            'descripcion' => 'Carne magra de pollo, ideal para cualquier receta.',
            'precio' => 4.00,
            'stock' => 200,
            'imagen_url' => 'pollo.jpg',
        ]);

        Producto::create([
            'nombre' => 'Carne de Res (Filetes, Molida, Chuletas)',
            'descripcion' => 'Carne de res fresca y jugosa, ideal para asados.',
            'precio' => 8.00,
            'stock' => 150,
            'imagen_url' => 'carne_res.jpg',
        ]);

        Producto::create([
            'nombre' => 'Cerdo (Costillas, Lomo, Chuletas)',
            'descripcion' => 'Carne de cerdo, perfecta para parrilladas.',
            'precio' => 7.50,
            'stock' => 120,
            'imagen_url' => 'cerdo.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pavo',
            'descripcion' => 'Carnes magras de pavo, ricas en proteínas.',
            'precio' => 5.50,
            'stock' => 80,
            'imagen_url' => 'pavo.jpg',
        ]);
        Producto::create([
            'nombre' => 'Salchichas',
            'descripcion' => 'Salchichas frescas, perfectas para parrilladas o acompañar tus platos.',
            'precio' => 3.00,
            'stock' => 200,
            'imagen_url' => 'salchicha.jpg',
        ]);

        Producto::create([
            'nombre' => 'Bacon',
            'descripcion' => 'Tiras de tocino crujiente, ideal para acompañar desayunos.',
            'precio' => 4.00,
            'stock' => 150,
            'imagen_url' => 'bacon.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pescado (Salmón, Tilapia, Atún)',
            'descripcion' => 'Pescado fresco de alta calidad, disponible en varias variedades.',
            'precio' => 6.00,
            'stock' => 100,
            'imagen_url' => 'pescado.jpg',
        ]);

        Producto::create([
            'nombre' => 'Mariscos (Camarones, Mejillones, Calamares)',
            'descripcion' => 'Mariscos frescos y jugosos, ideales para platos de mariscos.',
            'precio' => 7.00,
            'stock' => 80,
            'imagen_url' => 'marisco.jpg',
        ]);

        Producto::create([
            'nombre' => 'Carne de Cordero',
            'descripcion' => 'Carne de cordero tierna y jugosa, ideal para asados.',
            'precio' => 10.00,
            'stock' => 60,
            'imagen_url' => 'cordero.jpg',
        ]);

        Producto::create([
            'nombre' => 'Embutidos (Jamón, Chorizo, Salami)',
            'descripcion' => 'Selección de embutidos frescos, perfectos para bocadillos o tapas.',
            'precio' => 5.00,
            'stock' => 120,
            'imagen_url' => 'embutido.jpg',
        ]);

        Producto::create([
            'nombre' => 'Leche (Entera, Semidesnatada, Sin Lactosa)',
            'descripcion' => 'Leche fresca en varias presentaciones: entera, semidesnatada y sin lactosa.',
            'precio' => 1.50,
            'stock' => 200,
            'imagen_url' => 'leche.jpg',
        ]);

        Producto::create([
            'nombre' => 'Yogurt (Natural, Griego, Con Fruta)',
            'descripcion' => 'Yogur cremoso, disponible en varias presentaciones: natural, griego y con fruta.',
            'precio' => 1.80,
            'stock' => 150,
            'imagen_url' => 'yogurt.jpg',
        ]);

        Producto::create([
            'nombre' => 'Queso (Cheddar, Mozzarella, Crema, Fresco)',
            'descripcion' => 'Selección de quesos frescos: cheddar, mozzarella, crema y fresco.',
            'precio' => 2.50,
            'stock' => 130,
            'imagen_url' => 'queso.jpg',
        ]);

        Producto::create([
            'nombre' => 'Mantequilla',
            'descripcion' => 'Mantequilla fresca, ideal para untar o cocinar.',
            'precio' => 2.20,
            'stock' => 100,
            'imagen_url' => 'mantequilla.jpg',
        ]);

        Producto::create([
            'nombre' => 'Margarina',
            'descripcion' => 'Margarina vegetal, perfecta para untar o cocinar.',
            'precio' => 1.80,
            'stock' => 140,
            'imagen_url' => 'margarina.jpg',
        ]);

        Producto::create([
            'nombre' => 'Nata Líquida',
            'descripcion' => 'Nata líquida ideal para salsas, postres o batidos.',
            'precio' => 2.00,
            'stock' => 120,
            'imagen_url' => 'nata_liquida.jpg',
        ]);

        Producto::create([
            'nombre' => 'Helado',
            'descripcion' => 'Helado cremoso, disponible en varios sabores.',
            'precio' => 3.50,
            'stock' => 80,
            'imagen_url' => 'helado.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pan (Blanco, Integral, Baguette)',
            'descripcion' => 'Pan fresco, disponible en variedades: blanco, integral y baguette.',
            'precio' => 1.20,
            'stock' => 250,
            'imagen_url' => 'pan.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pan de Molde',
            'descripcion' => 'Pan de molde suave y esponjoso, ideal para hacer bocadillos.',
            'precio' => 1.00,
            'stock' => 200,
            'imagen_url' => 'pan_molde.jpg',
        ]);

        Producto::create([
            'nombre' => 'Panecillos',
            'descripcion' => 'Panecillos frescos y suaves, ideales para acompañar comidas.',
            'precio' => 0.80,
            'stock' => 180,
            'imagen_url' => 'panecillos.jpg',
        ]);

        Producto::create([
            'nombre' => 'Bollería (Croissants, Napolitanas, Panes Dulces)',
            'descripcion' => 'Deliciosa bollería fresca, perfecta para desayunos o meriendas.',
            'precio' => 2.30,
            'stock' => 150,
            'imagen_url' => 'bolleria.jpg',
        ]);

        Producto::create([
            'nombre' => 'Galletas',
            'descripcion' => 'Galletas crujientes y deliciosas, perfectas para acompañar un café.',
            'precio' => 1.50,
            'stock' => 200,
            'imagen_url' => 'galleta.jpg',
        ]);
        Producto::create([
            'nombre' => 'Pasteles',
            'descripcion' => 'Deliciosos pasteles en varias variedades, ideales para celebraciones.',
            'precio' => 10.00,
            'stock' => 50,
            'imagen_url' => 'pastel.jpg',
        ]);

        Producto::create([
            'nombre' => 'Tarta',
            'descripcion' => 'Tartas de diferentes sabores, perfectas para cualquier ocasión.',
            'precio' => 12.00,
            'stock' => 40,
            'imagen_url' => 'tarta.jpg',
        ]);

        Producto::create([
            'nombre' => 'Tortillas',
            'descripcion' => 'Tortillas suaves y frescas, ideales para tacos o wraps.',
            'precio' => 3.00,
            'stock' => 150,
            'imagen_url' => 'tortilla.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pan de Pita',
            'descripcion' => 'Pan de pita fresco y suave, perfecto para hacer shawarmas o mezze.',
            'precio' => 2.50,
            'stock' => 120,
            'imagen_url' => 'pan_pita.jpg',
        ]);

        Producto::create([
            'nombre' => 'Agua (Embotellada, Con Gas, Sin Gas)',
            'descripcion' => 'Agua embotellada disponible en varias opciones: con gas o sin gas.',
            'precio' => 1.00,
            'stock' => 200,
            'imagen_url' => 'agua.jpg',
        ]);

        Producto::create([
            'nombre' => 'Zumos (Naranja, Manzana, Piña, Multivitamínico)',
            'descripcion' => 'Jugos naturales de diversas frutas, ideales para empezar el día.',
            'precio' => 2.00,
            'stock' => 180,
            'imagen_url' => 'Zumo.jpg',
        ]);

        Producto::create([
            'nombre' => 'Refrescos (Colas, Limón, Naranja, Energía)',
            'descripcion' => 'Refrescos en varios sabores, refrescante y con burbujeas.',
            'precio' => 1.50,
            'stock' => 200,
            'imagen_url' => 'refresco.jpg',
        ]);

        Producto::create([
            'nombre' => 'Café (En Grano, Molido, Cápsulas)',
            'descripcion' => 'Café de alta calidad, disponible en grano, molido o cápsulas.',
            'precio' => 5.00,
            'stock' => 100,
            'imagen_url' => 'cafe.jpg',
        ]);

        Producto::create([
            'nombre' => 'Té (Verde, Negro, De Hierbas)',
            'descripcion' => 'Variedad de tés: verde, negro y de hierbas, perfectos para relajarse.',
            'precio' => 2.50,
            'stock' => 120,
            'imagen_url' => 'te.jpg',
        ]);

        Producto::create([
            'nombre' => 'Leche de Almendra, Soja, Avena',
            'descripcion' => 'Leche vegetal de almendra, soja y avena, ideal para quienes no consumen lácteos.',
            'precio' => 2.80,
            'stock' => 150,
            'imagen_url' => 'leche_vegetal.jpg',
        ]);

        Producto::create([
            'nombre' => 'Bebidas Alcohólicas (Cervezas, Vinos, Licores, Sidra)',
            'descripcion' => 'Variedad de bebidas alcohólicas, desde cervezas hasta licores finos.',
            'precio' => 5.00,
            'stock' => 100,
            'imagen_url' => 'bebidas_alcoholicas.jpg',
        ]);

        Producto::create([
            'nombre' => 'Bebidas Deportivas',
            'descripcion' => 'Bebidas energéticas y deportivas para mantenerte hidratado durante el ejercicio.',
            'precio' => 2.20,
            'stock' => 150,
            'imagen_url' => 'bebidas_deportivas.jpg',
        ]);

        Producto::create([
            'nombre' => 'Sopa Enlatada',
            'descripcion' => 'Sopas enlatadas, fáciles de preparar y perfectas para cualquier ocasión.',
            'precio' => 1.50,
            'stock' => 100,
            'imagen_url' => 'sopa_enlatada.jpg',
        ]);

        Producto::create([
            'nombre' => 'Verduras Enlatadas (Guisantes, Maíz, Champiñones)',
            'descripcion' => 'Verduras enlatadas, ideales para agregar a cualquier plato.',
            'precio' => 1.80,
            'stock' => 200,
            'imagen_url' => 'verduras_enlatadas.jpg',
        ]);

        Producto::create([
            'nombre' => 'Frutas Enlatadas',
            'descripcion' => 'Frutas enlatadas en almíbar, perfectas para postres o para consumir solas.',
            'precio' => 2.00,
            'stock' => 150,
            'imagen_url' => 'frutas_enlatadas.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pescado Enlatado (Atún, Sardinas)',
            'descripcion' => 'Pescado enlatado, ideal para ensaladas o sándwiches.',
            'precio' => 1.80,
            'stock' => 180,
            'imagen_url' => 'pescado_enlatado.jpg',
        ]);

        Producto::create([
            'nombre' => 'Tomate Enlatado',
            'descripcion' => 'Tomates enlatados, ideales para preparar salsas o guisos.',
            'precio' => 1.50,
            'stock' => 200,
            'imagen_url' => 'tomate_enlatado.jpg',
        ]);

        Producto::create([
            'nombre' => 'Legumbres en Conserva (Garbanzos, Alubias, Lentejas)',
            'descripcion' => 'Legumbres en conserva, fáciles de usar en tus guisos o ensaladas.',
            'precio' => 1.20,
            'stock' => 220,
            'imagen_url' => 'legumbres_conserva.jpg',
        ]);

        Producto::create([
            'nombre' => 'Salsas Enlatadas (Tomate, Pasta, Pesto)',
            'descripcion' => 'Salsas enlatadas, perfectas para tus platos de pasta o pizza.',
            'precio' => 2.50,
            'stock' => 180,
            'imagen_url' => 'salsas_enlatadas.jpg',
        ]);

        Producto::create([
            'nombre' => 'Aceitunas',
            'descripcion' => 'Aceitunas frescas, disponibles en diferentes variedades.',
            'precio' => 2.00,
            'stock' => 150,
            'imagen_url' => 'aceitunas.jpg',
        ]);

        Producto::create([
            'nombre' => 'Arroz (Blanco, Integral, Basmati, Jazmín)',
            'descripcion' => 'Arroz de calidad, disponible en varias variedades: blanco, integral, basmati y jazmín.',
            'precio' => 1.30,
            'stock' => 250,
            'imagen_url' => 'arroz.jpg',
        ]);

        Producto::create([
            'nombre' => 'Pasta (Espaguetis, Macarrones, Fideos)',
            'descripcion' => 'Pasta de calidad, disponible en diferentes formas: espaguetis, macarrones y fideos.',
            'precio' => 1.50,
            'stock' => 200,
            'imagen_url' => 'pasta.jpg',
        ]);

        Producto::create([
            'nombre' => 'Harina (De Trigo, Integral, De Avena)',
            'descripcion' => 'Harina de alta calidad, ideal para tus recetas de panadería y repostería.',
            'precio' => 1.00,
            'stock' => 300,
            'imagen_url' => 'harina.jpg',
        ]);
    }
}
