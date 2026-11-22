Eleazar Rolando Condarco Beltran

P2.1 — Elegir


Operación__________________Frecuencia por jornada_____________Estructura elegida_______________Costo temporal
Registrar_______________________120.000 veces____________________Heap + Hash_______________________O(log n)
Preparar Siguiente_______________120.000 veces_____________________Heap_____________________________O(log n)
Esta Pendiente___________________40.000 veces______________________Hash_____________________________O(1)
Pendientes______________________Muy frecuente___________________Contador___________________________O(1)



p2.2 - ¿Por qué no sirve una lista simple?

la lista simple funciona correctamente pero cuando hay muchos pedidos se vuelve lenta Para encontrar el pedido más urgente o verificar si un pedido sigue pendiente es necesario revisar muchos elementos de la lista

En una jornada normal se manejan 120.000 pedidos y 40.000 consultas por lo que la cantidad de búsquedas es muy grande

Con una lista simple:

120.000 × 120.000 + 40.000 × 120.000 = 19.200.000.000

En cambio usando una cola de prioridad junto con una tabla hass:

120.000 × 17 + 120.000 × 17 + 40.000 = 4.120.000 operaciones

Por esta razón la lista simple no es adecuada para una jornada con tantos pedidos




p.2.3 - Una condición en la que cambiarías de opinión

se cambiaria si hubiera pocos pedidos. En ese caso una lista simple podría ser suficiente por su simplicidad de implementación.



