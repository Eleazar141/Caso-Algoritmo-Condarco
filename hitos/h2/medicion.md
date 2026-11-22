O(n)

Comparamos ambas formas de trabajo probando con 50, 60 y 70 postulantes. Primero verificamos que todo funcionara bien, luego repetimos cada prueba 3 veces y calculamos el tiempo promedio que tomó buscar y revisar los datos.

n---------------	Ingenua (ms)-------------	Veces más	---------------Elegida (ms)----------	Veces más

8---------------	0.001431	-----------------________-----------------0.000318	---------------------

16---------------	0.005007---------------------3.50x	----------------0.000715---------------	2.25x

32----------------0.017246---------------------3.44x	----------------0.000397----------------0.56x

64--------------	0.065962---------------------3.82x------------------0.001351----------------3.40x

al duplicar la cantidad de postulantes el tiempo de la solucion ingenua aumento varias veces lo que se parece a un costo o(n²)
la solucion elegida fue mas rapida porque los postulantes estaban organizados por categoria
los tiempos cambiaron un poco entre las pruebas por el ruido normal de la medicion
