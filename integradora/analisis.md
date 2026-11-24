Eleazar Rolando Condarco Beltran

a) Costo O de Planificador

O(2ⁿ)

porque para cada paquete se prueban dos opciones, llevarlo o no llevarlo, al aumentar los paquetes la cantidad de combinaciones crece muy rapido


b) ¿Por que no se aplica el teorema maestro y cuanto cuesta?

no se puede usar el teorema maestro porque el problema va disminuyendo de uno en uno (n-1) y no partiendose en mitades

el costo sigue siendo O(2ⁿ) porque cada paquete genera dos posibilidades, tomarlo o dejarlo

c) ¿Sirve un algoritmo voraz (ganancia por kg)?

no siempre sirve, por ejemplo

capacidad = 10 kg

paquete A = 6 kg, gana 60 Bs

paquete B = 4 kg, gana 50 Bs

paquete C = 10 kg, gana 101 Bs

el voraz elegiría primero el paquete C porque tiene mejor ganancia por kg y ganaría 101 Bs

pero si se llevan A y B juntos la ganancia sería 110 Bs que es mayor

por eso el metodo voraz puede dejar pasar la mejor solucion

estrategia elegida: programacion dinamica

funciona porque guarda resultados que ya calculo y los vuelve a usar cuando los necesita otra vez

costo: O(n × capacidad)



d) Estructura para Esta en el viaje

usaria una tabla hash (diccionario o arreglo asociativo) con los codigos de los paquetes elegidos asi consultar si un paquete esta en el viaje cuesta O(1) en promedio

si recorremos toda la lista cada vez el costo sería O(n)

por eso la tabla hash es mucho mas rápida cuando se consulta miles de veces
