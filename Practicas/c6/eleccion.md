El proceso que voy a optimizar este mes es el desorden y el tiempo perdido al buscar alumnos y corregir sus datos para armar las actas de examen de la autoescuela. Los que sufren este dolor de cabeza son los compañeros de administración, quienes se vuelven locos cruzando información cada vez que termina una prueba. El problema real no es solo escribir las notas, sino que para un examen de 70 personas se tiene que verificar si sus datos están bien o si hubo un error de tipeo en el DNI o el apellido. Además, si un dato viene mal desde la inscripción, tienen que detener el proceso para corregirlo en ese momento. Todo este trabajo de buscar, corregir datos erróneos y recién después pasarlos a la lista final tarda entre 1 y 2 horas por examen. Es una tarea lenta, estresante y llena de interrupciones, donde es muy fácil que un error pase desapercibido o que un alumno aparezca duplicado por el cansancio visual.
Datos de Ejemplo
Nro	Cédula de Identidad	Nombre(s)	Primer Apellido	Segundo Apellido	Fecha de Nacimiento	Categoría
1	8799741	MARCO ALEXIS	AGUILAR	FLORES	14/12/2005	M
2	9441831	ISAIAS	CHOQUE	ANAVI	03/08/2001	M
3	9318663	MARIO	CRUZ	MAYO	22/07/1995	M
4	8973104	NINETH ADRIELY	ORELLANA	RODRIGUEZ	18/06/2005	M
5	12777017	LUIS JOSE	TORRICO	SALINAS	10/01/2007	M
6	9493233	BRAULIO	CRUZ	QUENAYA	25/03/2007	P
7	8973104	NINETH ADRIELY	ORELLANA	RODRIGUEZ	18/06/2005	P
8	13751229	SEBASTIAN GUSTAVO	VILLARROEL	VARGAS	25/04/2008	P
9	13161338	ADALY	AGUILAR	MAMANI	14/02/2004	A
10	9329419	WILBER	AGUILAR	MAMANI	03/01/1999	A
11	8701576	NELSON	ALVAREZ	QUIROZ	20/06/2000	A
12	1689484	GILBERTO	ARAUZ	CHIPUNAVI	30/09/1969	A
13	5120491	EMILIO	CALLAHUARA	SONCKO	16/08/1974	A
14	12619073	CLAUDIA	CAPUCIRI	MAMANI	24/04/2003	A
15	7942728	BENJAMIN ARMANDO	CHAVEZ	CLAROS	31/03/2005	A
16	6521042	TOMAS	CHIPANA	CUCHILLO	24/07/1982	A
17	9462934	WILY	HINOJOSA	HUARAYA	02/02/2004	A
18	12433100	LUIS ANGEL	PATI	FLORES	20/05/1997	A
19	9402144	RUDY ROSMAN	QUISPE	MAMANI	09/03/2003	A
20	9350891	KARLA OFELIA	RODRIGUEZ	SEGOVIA	07/05/1999	A




Datos
Como máximo de inscritos se tiene 70, en el peor de los casos reduce a 50 tomando en cuenta que el examen se realiza solo un dia determinado en la semana (Viernes)

La Operación que más Pesa
Buscar y Comparar
Se tiene que buscar la planilla del postulante junto con la fotocopia de su cédula de identidad para comparar los datos y verificar que no existan errores.

Dos candidatos (peor caso)

Candidato A: Búsqueda lineal en listas sin ordenar

En este método, cada vez que se procesa un alumno que rindió el examen, se revisa la lista de inscritos uno por uno para verificar que sus datos sean correctos y comprobar que no esté duplicado.

Complejidad estimada: O(n²)
¿Por qué?
Porque para cada alumno puede ser necesario revisar muchos registros de la lista (4 listas para firmar y registrar). Si el alumno está al final o no existe, hay que recorrer casi toda la información. Cuando esto se repite para varios alumnos, el tiempo de trabajo aumenta considerablemente.

Candidato B: Organización por categorías (A, B, C, M, P)

La propuesta es separar los alumnos desde el inicio según la categoría de licencia que están Postulando. De esta manera, cuando se necesite buscar o verificar a un alumno, primero se consulta la categoría correspondiente en lugar de revisar toda la información mezclada.

Complejidad estimada: O(n)
¿Por qué?
Porque se recorre cada lista una sola vez y los alumnos ya están organizados. Esto reduce el tiempo de búsqueda, evita confusiones entre categorías y facilita la generación de actas para cada tipo de licencia.


Elección: Candidato B - Organización por categorías (A, B, C, M y P)

Esta alternativa es mejor porque actualmente los datos de los postulantes llegan mezclados y muchas veces es necesario buscar una planilla específica para comparar la información con la fotocopia del carnet de identidad. Cuando todos los registros están juntos, la búsqueda se vuelve más lenta y es más fácil cometer errores.
La propuesta consiste en organizar a los alumnos según la categoría de licencia que desean obtener (A, B, C, M o P). De esta manera, cuando se necesite revisar o corregir información, primero se busca en la categoría correspondiente y no en toda la lista de inscritos.
Tomando en cuenta que normalmente se tienen alrededor de 50 a 70 inscritos por examen, separar los registros por categoría ayuda a que el trabajo sea más ordenado y rápido. Además, facilita la revisión de datos cuando existe algún error en el nombre, apellido o número de documento.
Comparación general

Candidato A
•	Todos los alumnos se encuentran en una sola lista.
•	Cada búsqueda requiere revisar más registros.
•	Existe mayor posibilidad de confusión o duplicación de datos.
•	La revisión de documentación toma más tiempo.

Candidato B
•	Los alumnos están separados por categorías.
•	Cada búsqueda se realiza sobre un grupo más pequeño.
•	Es más fácil validar la información.
•	Reduce el tiempo necesario para revisar documentos y preparar las actas.
•	¿Por qué elijo este método?
•	Mantiene la información mejor organizada.
•	Facilita encontrar a los postulantes cuando se necesita verificar sus datos.
•	Reduce la cantidad de registros que se deben revisar.
•	Ayuda a detectar errores con mayor rapidez.
•	Simplifica el trabajo administrativo al momento de elaborar actas y listas de examen.

Conclusión

El candidato B es la mejor opción porque se adapta mejor a la forma en que trabaja la autoescuela. Al organizar a los alumnos por categorías, la búsqueda de información resulta más rápida, el proceso es más ordenado y se reduce la posibilidad de cometer errores durante la verificación de datos y la preparación de la documentación.


¿Cómo se va a medir?

Para comparar los dos métodos y saber cuál funciona mejor, se realizarán pruebas con dos cantidades de postulantes: 50 y 70 inscritos. Estas cantidades nos permitirán observar cómo se comporta cada método cuando aumenta el número de personas que se deben revisar.

Protocolo de medición

Para realizar las pruebas, seguiremos estos pasos:
Primero, ejecutaremos ambos métodos una vez para comprobar que funcionen correctamente. Esta prueba no contará para los resultados.
Luego, realizaremos 5 pruebas con cada método.
En cada ejecución, registraremos la cantidad de comparaciones que se realizan para buscar y verificar la información de los postulantes.
Una vez terminadas las pruebas, calcularemos el promedio de comparaciones de cada método.
Compararemos los resultados obtenidos por el Candidato A y el Candidato B.

Cantidad 50 _____(50 inscritos)
Métod___________<Comparaciones________Complejidad
Candidato _A	______2,500________________O(n²)
Candidato B	________500_________________	O(n)


Cantidad 70 (70 inscritos)
Método	_________Comparaciones_______Complejidad
Candidato A_______	4,900	____________O(n²)
Candidato B	________980	_____________O(n)



Para 50 inscritos:
Candidato A: aproximadamente 2.500 comparaciones.
Candidato B: aproximadamente 500 comparaciones.

Para 70 inscritos:
Candidato A: aproximadamente 4.900 comparaciones.
Candidato B: aproximadamente 980 comparaciones.

¿Qué esperamos conseguir?
Con estas pruebas esperamos comprobar que organizar a los postulantes por categorías ayuda a reducir las comparaciones y facilita la búsqueda de información. De esta manera, podremos identificar cuál de los dos métodos es más eficiente y cuál nos permite ahorrar más tiempo al momento de verificar los datos y preparar las actas del examen.

Finalmente, analizaremos cuál de los dos necesita menos operaciones y cuál resulta más conveniente para realizar el trabajo.
Resultados estimados
