import re

path = r'd:\Fork\TAD\docs\Memoria_Proyecto.md'
with open(path, 'r', encoding='utf-8') as f:
    content = f.read()

# Add placeholder after Home wireframe
content = re.sub(
    r'(## 1\. Pantalla de Inicio \(Home\) \(`\/`\)\n\nVista principal de bienvenida de la tienda con productos destacados y categorías\.)\n\n### Idea Inicial \(Wireframe\)\n```mermaid',
    r'\1\n\n### Idea Inicial (Wireframe)\n```mermaid',
    content
)

# Because my previous replace only added "### Idea Inicial (Wireframe)", the end of the block wasn't updated.
# Let's just find the end of each mermaid block and append the "Resultado Final" text.
# The document has:
# 1. Pantalla de Inicio (Home)
# 2. Catálogo / Tienda
# 3. Carrito de Compras (Modal / Sidebar)
# 4. Finalizar Compra (Checkout)

# Let's replace the occurrences of "```" that end a mermaid block for each section.
# Actually, it's easier to just do simple string replacements.

replacements = [
    (
        "Cat5[\"Cat 5\"]:4\n```",
        "Cat5[\"Cat 5\"]:4\n```\n\n### Resultado Final\n> **Nota:** Inserta aquí la captura real de la Home (`docs/pantallas/home.png`).\n\n![Home Final](./pantallas/home.png)\n"
    ),
    (
        "Prod4[\"Producto 4 - 45€\"]:7\n```",
        "Prod4[\"Producto 4 - 45€\"]:7\n```\n\n### Resultado Final\n> **Nota:** Inserta aquí la captura real del Catálogo (`docs/pantallas/catalogo.png`).\n\n![Catálogo Final](./pantallas/catalogo.png)\n"
    ),
    (
        "BtnCheckout[\"Proceder al Pago\"]:20\n```",
        "BtnCheckout[\"Proceder al Pago\"]:20\n```\n\n### Resultado Final\n> **Nota:** Inserta aquí la captura real del Carrito (`docs/pantallas/carrito.png`).\n\n![Carrito Final](./pantallas/carrito.png)\n"
    ),
    (
        "BtnConfirm[\"Pagar Seguro\"]:10\n```",
        "BtnConfirm[\"Pagar Seguro\"]:10\n```\n\n### Resultado Final\n> **Nota:** Inserta aquí la captura real del Checkout (`docs/pantallas/checkout.png`).\n\n![Checkout Final](./pantallas/checkout.png)\n"
    )
]

for old, new in replacements:
    content = content.replace(old, new)

with open(path, 'w', encoding='utf-8') as f:
    f.write(content)
