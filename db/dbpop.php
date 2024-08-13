<?php

include "../model/Products.php";


$productsData = [
    [
        'name' => 'Elegant Dress by BrandA',
        'price' => 99.99,
        'gender' => 'w',
        'description' => 'Made from silk, this elegant piece is soft and perfect for special occasions.',
        'image' => '../view/pics/women/Elegant_Dress.jpg'
    ],
    [
        'name' => 'Sporty Shirt by BrandB',
        'price' => 29.99,
        'gender' => 'm',
        'description' => 'Made from cotton, this sporty piece is breathable and perfect for workout.',
        'image' => '../view/pics/men/Sporty_Shirt.jpg'
    ],
    [
        'name' => 'Casual Jeans by BrandC',
        'price' => 49.99,
        'gender' => 'm',
        'description' => 'Made from denim, this casual piece is durable and perfect for everyday wear.',
        'image' => '../view/pics/men/Casual_Jeans.jpg'
    ],
    [
        'name' => 'Formal Jacket by BrandD',
        'price' => 129.99,
        'gender' => 'm',
        'description' => 'Made from wool, this formal piece is warm and perfect for office.',
        'image' => '../view/pics/men/Formal_Jacket.jpg'
    ],
    [
        'name' => 'Chic Skirt by BrandE',
        'price' => 39.99,
        'gender' => 'w',
        'description' => 'Made from linen, this chic piece is lightweight and perfect for vacation.',
        'image' => '../view/pics/women/Chic_Skirt.jpg'
    ],
    [
        'name' => 'Trendy Blouse by BrandA',
        'price' => 34.99,
        'gender' => 'w',
        'description' => 'Made from polyester, this trendy piece is stretchy and perfect for party.',
        'image' => '../view/pics/women/Trendy_Blouse.jpg'
    ],
    [
        'name' => 'Classic Sweater by BrandB',
        'price' => 59.99,
        'gender' => 'm',
        'description' => 'Made from wool, this classic piece is warm and perfect for everyday wear.',
        'image' => '../view/pics/men/Classic_Sweater.jpg'
    ],
    [
        'name' => 'Stylish Shorts by BrandC',
        'price' => 24.99,
        'gender' => 'm',
        'description' => 'Made from cotton, this stylish piece is comfortable and perfect for vacation.',
        'image' => '../view/pics/men/Stylish_Shorts.jpg'
    ],
    [
        'name' => 'Modern Dress by BrandD',
        'price' => 89.99,
        'gender' => 'w',
        'description' => 'Made from silk, this modern piece is soft and perfect for evening.',
        'image' => '../view/pics/women/Modern_Dress.jpg'
    ],
    [
        'name' => 'Elegant Pants by BrandE',
        'price' => 79.99,
        'gender' => 'w',
        'description' => 'Made from linen, this elegant piece is breathable and perfect for office.',
        'image' => '../view/pics/women/Elegant_Pants.jpg'
    ],
    [
        'name' => 'Casual T-Shirt by BrandA',
        'price' => 19.99,
        'gender' => 'm',
        'description' => 'Made from cotton, this casual piece is soft and perfect for everyday wear.',
        'image' => '../view/pics/men/Casual_T-Shirt.jpg'
    ],
    [
        'name' => 'Formal Blazer by BrandB',
        'price' => 149.99,
        'gender' => 'w',
        'description' => 'Made from polyester, this formal piece is durable and perfect for office.',
        'image' => '../view/pics/women/Formal_Blazer.jpg'
    ],
];

// die Daten vom Array productsData werden in der Datenbank über der Methode erstellt
foreach ($productsData as $product) {
    Products::createProducts($product['name'], $product['price'], $product['gender'], $product['description'], $product['image']);
}