with open(r'd:\Fork\TAD\docs\Memoria_Proyecto.md', 'a', encoding='utf-8') as f_out:
    f_out.write('\n\n---\n\n# Anexo A: Documentación de Despliegue con Docker\n\n')
    with open(r'd:\Fork\TAD\docs\Despliegue_Docker.md', 'r', encoding='utf-8') as f_in:
        f_out.write(f_in.read())
