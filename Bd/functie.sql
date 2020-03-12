CREATE OR REPLACE FUNCTION f_produs_cautat(p_oras varchar2)
RETURN varchar2 AS
   v_nume VARCHAR2(1000);
   v_numar INT;
BEGIN
    Select nume into v_nume from (
    select p.nume, count(*) from produse p
    join combinari c on c.id_produs = p.id_produs
    join comanda c1 on c1.id_combinari = c.id_combinari
    join livrari l on l.id_livrare = c1.id_comanda
    join clienti m on m.id_client = l.id_client and  m.oras = p_oras
    GROUP BY p.nume, p.id_produs order by 2 desc) where rownum <= 1; 
    return v_nume;
    EXCEPTION
    WHEN no_data_found THEN
    return 'Nu exista nici un produs disponibil';
END;

/
CREATE OR REPLACE FUNCTION f_desert_cautat(p_oras varchar2)
RETURN varchar2 AS
   v_nume VARCHAR2(1000);
   v_numar INT;
BEGIN
    Select nume into v_nume from (
    select p.nume, count(*) from produse p
    join combinari c on c.id_produs = p.id_produs
    join comanda c1 on c1.id_combinari = c.id_combinari
    join livrari l on l.id_livrare = c1.id_comanda
    join clienti m on m.id_client = l.id_client and  m.oras = p_oras and p.id_categorie = 'Deserturi'
    GROUP BY p.nume, p.id_produs order by 2 desc) where rownum <= 1; 
    return v_nume;
    EXCEPTION
    WHEN no_data_found THEN
    return 'Nu exista nici un fel de desert disponibil';
END;
/
CREATE OR REPLACE FUNCTION f_paste_cautat(p_oras varchar2)
RETURN varchar2 AS
   v_nume VARCHAR2(1000);
   v_numar INT;
BEGIN
    Select nume into v_nume from (
    select p.nume, count(*) from produse p
    join combinari c on c.id_produs = p.id_produs
    join comanda c1 on c1.id_combinari = c.id_combinari
    join livrari l on l.id_livrare = c1.id_comanda
    join clienti m on m.id_client = l.id_client and  m.oras = p_oras and p.id_categorie = 'Paste'
    GROUP BY p.nume, p.id_produs order by 2 desc) where rownum <= 1; 
    return v_nume;
    EXCEPTION
    WHEN no_data_found THEN
    return 'Nu exista nici un fel de paste disponibil';
END;
/
CREATE OR REPLACE FUNCTION f_pizza_cautat(p_oras varchar2)
RETURN varchar2 AS
   v_nume VARCHAR2(1000);
   v_numar INT;
BEGIN
    Select nume into v_nume from (
    select p.nume, count(*) from produse p
    join combinari c on c.id_produs = p.id_produs
    join comanda c1 on c1.id_combinari = c.id_combinari
    join livrari l on l.id_livrare = c1.id_comanda
    join clienti m on m.id_client = l.id_client and  m.oras = p_oras and p.id_categorie = 'Pizza'
    GROUP BY p.nume, p.id_produs order by 2 desc) where rownum <= 1; 
    return v_nume;
    EXCEPTION
    WHEN no_data_found THEN
    return 'Nu exista nici un fel de pizza disponibil';
END;
/


   

CREATE OR REPLACE FUNCTION f_clienti_fluctuatie 
RETURN FLOAT AS
   v_numar FLOAT;
   v_min DATE;
   v_max DATE;
BEGIN
    select count(*) INTO v_numar  from clienti;
    select Max(data_inregistrare) into v_max from clienti;
    select Min(data_inregistrare) into v_min from clienti;
    return trunc(v_numar / (v_max - v_min),3);
    
END;
/
CREATE OR REPLACE FUNCTION f_clienti_azi
RETURN varchar2 AS
   v_numar FLOAT;
BEGIN
    select avg(avgsal) INTO v_numar from ( select count(*) as avgsal from clienti 
    where TO_CHAR (data_inregistrare, 'MM, DD, YYYY') = TO_CHAR (SYSDATE, 'MM, DD, YYYY'));
    if v_numar > 0 then
      return v_numar;
    else
       return 'Nici un client nou astazi';
    END IF;
    
END;
/
CREATE OR REPLACE FUNCTION f_restaurant_slab(p_oras varchar2)
RETURN VARCHAR2 AS
   v_nume VARCHAR2(300);
BEGIN
    select nume INTO v_nume from (
    select r.nume, count(*) from restaurant r
    join combinari p on p.id_restaurant = r.id_restaurant
    join comanda c on c.id_combinari = p.id_combinari and r.oras = p_oras
    group by r.id_restaurant, r.nume order by 2 asc) where rownum <= 1;
    return v_nume;
    EXCEPTION
    WHEN no_data_found THEN
    return 'Nu exista restaurante :(';
END;
/
CREATE OR REPLACE FUNCTION f_restaurant_bune(p_oras varchar2)
RETURN VARCHAR2 AS
   v_nume VARCHAR2(300);
BEGIN
    select nume INTO v_nume from (
    select r.nume, count(*) from restaurant r
    join combinari p on p.id_restaurant = r.id_restaurant
    join comanda c on c.id_combinari = p.id_combinari and r.oras = p_oras
    group by r.id_restaurant, r.nume order by 2 desc) where rownum <= 1;
    return v_nume;
    EXCEPTION
    WHEN no_data_found THEN
    return 'Nu exista restaurante :(';
END;
/
CREATE OR REPLACE FUNCTION f_best_deal(p_oras varchar2, p_produs varchar2)
RETURN varchar2 AS
   v_pret FLOAT;
BEGIN
    select MIN(p.pret) INTO v_pret from combinari p
    join produse d on d.id_produs = p.id_produs
    join restaurant r on p.id_restaurant = r.id_restaurant and d.nume = p_produs and instr(r.oras, p_oras) > 0;
    return v_pret;
    EXCEPTION
    WHEN no_data_found THEN
    return 0;
END;
/
CREATE OR REPLACE FUNCTION f_produs_femei(p_oras varchar2)
RETURN varchar2 AS
   v_nume VARCHAR2(1000);
   v_numar INT;
BEGIN
    Select nume into v_nume from (
    select p1.nume, COUNT(*) from combinari p 
    join restaurant r on r.id_restaurant = p.id_restaurant
    join produse p1 on p1.id_produs = p.id_produs
    join comanda c on p.id_combinari = c.id_combinari
    join livrari c1 on c1.id_livrare = c.id_comanda
    join clienti c2 on c2.id_client = c1.id_client
    where c1.data_livrare >  SYSDATE - 3 and r.oras = p_oras and c2.sex = 'Feminin'
    GROUP BY p1.nume, p.id_produs order by 2 desc) where rownum <= 1; 
    return v_nume;
    EXCEPTION
    WHEN no_data_found THEN
    return 'Fetele sunt gospodine, gatesc acasa';
END;
/
CREATE OR REPLACE FUNCTION f_produs_barbati(p_oras varchar2)
RETURN varchar2 AS
   v_nume VARCHAR2(1000);
   v_numar INT;
BEGIN
    Select nume into v_nume from (
    select p1.nume, COUNT(*) from combinari p 
    join restaurant r on r.id_restaurant = p.id_restaurant
    join produse p1 on p1.id_produs = p.id_produs
    join comanda c on p.id_combinari = c.id_combinari
    join livrari c1 on c1.id_livrare = c.id_comanda
    join clienti c2 on c2.id_client = c1.id_client
    where c1.data_livrare <  SYSDATE - 3 and r.oras = p_oras and c2.sex = 'Masculin'
    GROUP BY p1.nume, p.id_produs order by 2 desc) where rownum <= 1; 
    return v_nume;
    EXCEPTION
    WHEN no_data_found THEN
    return 'Nu au bani';
END;
/
CREATE OR REPLACE FUNCTION f_fluctuatie_comanda(p_client varchar2)
RETURN FLOAT AS
   CURSOR lista_comezni  IS
       SELECT data_livrare FROM livrari where id_client = p_client order by 1 asc;
   v_nume VARCHAR2(1000);
   v_numar FLOAT;
   v_intru INT;
   v_data DATE;
   v_data_aux DATE;
   v_contor INT;
   v_div FLOAT;
BEGIN
    v_intru := 0;
    v_numar := 0;
    v_contor := 0;
    v_nume := 'buna';
    v_div := 0;
    OPEN lista_comezni;
    LOOP
        FETCH lista_comezni INTO v_data;
        EXIT WHEN lista_comezni%NOTFOUND;
        IF (v_intru = 0) THEN 
        v_data_aux := v_data;
        v_intru := v_intru + 1;
        ELSE 
        v_numar := v_numar + (v_data - v_data_aux) / 2;
        v_data_aux := v_data;
        v_contor := 0;
        v_div := v_div + 1;
        END IF;
        
    END LOOP;
    CLOSE lista_comezni;  
    if v_div = 0 then
      return v_numar / 1;
    else
     return v_numar / v_div;
    end if;
END;
/
CREATE OR REPLACE FUNCTION f_afisare_comenzi(p_oras varchar2)
RETURN varchar2 AS
   CURSOR lista_comezni  IS
       SELECT c.adresa, l.id_livrare FROM livrari l
       join clienti c on c.id_client = l.id_client and  oras = 'Iasi' and l.data_livrare >= sysdate - 3;
   v_id INT;
   v_adresa VARCHAR2(1000);
BEGIN
    OPEN lista_comezni;
    LOOP 
        FETCH lista_comezni INTO v_adresa, v_id;
        EXIT WHEN lista_comezni%NOTFOUND;
        DBMS_OUTPUT.PUT_LINE(v_adresa || ' ' || v_id);        
    END LOOP;
    CLOSE lista_comezni;   
    return v_adresa;
END;
/
CREATE OR REPLACE FUNCTION f_distanta_strada(p_oras varchar2, p_strada varchar2)
RETURN INT AS
   v_numar INT;
BEGIN
    SELECT distanta INTO v_numar from oras where nume = p_oras and INSTR(p_strada, strada) > 0;
    return v_numar;
END;

/
CREATE OR REPLACE FUNCTION f_livrari(p_comanda varchar2, p_oras varchar2, p_start TIMESTAMP, p_end TIMESTAMP)
RETURN varchar2 AS
    v_nume VARCHAR2(1000);
   CURSOR lista_strada  IS
       select DISTINCT(SUBSTR((REVERSE(SUBSTR(REVERSE(c.adresa), INSTR(REVERSE(c.adresa), ',') + 1))),6)) from clienti c
       join livrari l on c.id_client = l.id_client and l.data_livrare >= p_start and l.data_livrare <= p_end and c.oras = p_oras ;
   TYPE RecType IS RECORD
    (
      value1   VARCHAR2(1000),
      value2   VARCHAR2(1000),
      value3   FLOAT
    );
    TYPE TblType IS TABLE OF RecType;
    TYPE TblOfTblType IS TABLE OF TblType;
    matrix   TblOfTblType := TblOfTblType();
    noduri TblOfTblType := TblOfTblType();
   v_nr FLOAT;
   v_s1 VARCHAR2(1000);
   v_s2 VARCHAR2(1000); 
   v_dis FLOAT;
   v_i INT;
   v_j INT;
   v_ok INT;
   v_marime INT;
   v_poz INT;
   v_pozmin INT;
   v_maxim INT;
   v_cost INT;
   v_start INT;
   v_last VARCHAR2(100);
   v_lista VARCHAR2(10000);
   v_contor INT;
   v_km INT;
   v_numar INT;
BEGIN
   v_i := 1;
   select COUNT(DISTINCT(SUBSTR((REVERSE(SUBSTR(REVERSE(c.adresa), INSTR(REVERSE(c.adresa), ',') + 1))),6))) into v_marime from clienti c
  join livrari l on c.id_client = l.id_client and l.data_livrare >= p_start and l.data_livrare <= p_end  and c.oras = p_oras;
  
   if v_marime = 0 then
      return '0';
    end if;
   matrix.EXTEND(v_marime);
   noduri.EXTEND(v_marime);
    OPEN lista_strada;
    LOOP 
        FETCH lista_strada INTO v_nume;
        EXIT WHEN lista_strada%NOTFOUND;
        select count(*) into v_marime from strazi where strada1 = v_nume;
        matrix(v_i) := TblType();
        matrix(v_i).EXTEND(v_marime);
        noduri(v_i) := TblType();
        noduri(v_i).EXTEND(1);
        v_j := 1;
        DECLARE
          CURSOR lista_strazi  IS
          SELECT strada1, strada2, distanta FROM strazi WHERE strada1 = trim(ltrim(v_nume));
        BEGIN
          OPEN lista_strazi;
          LOOP 
            FETCH lista_strazi INTO v_s1, v_s2, v_dis;
            EXIT WHEN lista_strazi%NOTFOUND;
            matrix(v_i)(v_j).value1 := v_s1;
            matrix(v_i)(v_j).value2 := v_s2;
            matrix(v_i)(v_j).value3 := v_dis; 
            noduri(v_i)(1).value1 := v_s1;
            noduri(v_i)(1).value2 := ' ';
            noduri(v_i)(1).value3 := 0; 
            v_j := v_j + 1;
          END LOOP;
          CLOSE lista_strazi;
        END LOOP;
        v_i := v_i + 1;
    END LOOP;
   CLOSE lista_strada;
   
     v_maxim := 20;
     FOR i IN 1 .. noduri.COUNT LOOP
     SELECT distanta into v_cost from strazi where strada1 = 'sediu' and strada2 = noduri(i)(1).value1;
     IF v_cost < v_maxim THEN
        v_poz := i;
        v_maxim := v_cost;
     END IF;
     END LOOP;
    v_km := v_maxim;
   v_start := v_poz;
   v_ok := 0;
   LOOP
       v_maxim := 20;
       v_ok := 0;
       noduri(v_poz)(1).value3 := 1;
       FOR i IN 1 .. noduri.COUNT LOOP
         IF i not like v_poz and  noduri(i)(1).value3 = 0 then
         SELECT distanta into v_cost from strazi where strada1 = noduri(v_poz)(1).value1 and strada2 = noduri(i)(1).value1;
            IF v_cost < v_maxim THEN
            v_maxim := v_cost;
            v_pozmin := i;
            v_ok := 1;
            END IF;
         END IF;
       END LOOP;
       IF v_ok = 1 THEN
          v_km := v_km + v_maxim;
          noduri(v_pozmin)(1).value2 := v_poz;
          v_poz := v_pozmin;
       END IF;
   EXIT WHEN v_ok = 0;
   END LOOP;
   
   SELECT distanta into v_cost from strazi where strada1 = noduri(v_poz)(1).value1 and strada2 = 'sediu';
    v_km := v_km + v_cost;
   
   if p_comanda = 'profit' then
      select count(SUBSTR((REVERSE(SUBSTR(REVERSE(c.adresa), INSTR(REVERSE(c.adresa), ',') + 1))),6))  into v_numar from clienti c
     join livrari l on c.id_client = l.id_client and l.data_livrare >= p_start and l.data_livrare <= p_end and c.oras = p_oras;
     return (v_numar * 5) -  ((v_km * (7 * 5.60))/100);
   ELSE
     v_last := ' ';
     v_lista := 'sediu';
     v_contor := 0;
     LOOP
       EXIT WHEN v_contor = noduri.COUNT;
       FOR i IN 1 .. noduri.COUNT LOOP
          IF noduri(i)(1).value2 = v_last THEN
               v_last := i;
               v_contor := v_contor + 1;
               v_lista := v_lista || ' - ' || noduri(i)(1).value1;
          END IF;
       END LOOP;  
     END LOOP;
     v_lista := v_lista || ' - sediu' ;
     DBMS_OUTPUT.PUT_LINE(v_lista);
     return v_lista;
    END IF;
   
END;
/

CREATE OR REPLACE FUNCTION f_profit_interval_lunar(p_oras varchar2)
RETURN FLOAT AS
v_aux VARCHAR2(1000);
v_start TIMESTAMP;
v_intermediar TIMESTAMP;
v_end TIMESTAMP;
v_sum FLOAT;
v_adun FLOAT;
v_scad TIMESTAMP;
BEGIN
    select ((systimestamp) - INTERVAL '30 01:00:00.0' DAY TO SECOND) INTO v_start from dual;
    select systimestamp into v_end from dual;
    v_sum := 0;
    LOOP
    EXIT WHEN v_start > v_end;
    v_intermediar := v_start + INTERVAL '0 01:00:00.0' DAY TO SECOND;
    v_aux := f_livrari('profit', p_oras, v_start, v_intermediar);
    v_adun := v_aux;
    v_sum := v_sum + v_adun;
    v_start := v_start + INTERVAL '0 01:00:00.0' DAY TO SECOND;
    END LOOP;
    return v_sum;
END;
/
CREATE OR REPLACE FUNCTION f_profit_interval_anual(p_oras varchar2)
RETURN FLOAT AS
v_aux VARCHAR2(1000);
v_start TIMESTAMP;
v_intermediar TIMESTAMP;
v_end TIMESTAMP;
v_sum FLOAT;
v_adun FLOAT;
v_scad TIMESTAMP;
BEGIN
    select ((systimestamp) - INTERVAL '99 01:00:00.0' DAY TO SECOND) INTO v_start from dual;
    v_start := v_start - INTERVAL '99 01:00:00.0' DAY TO SECOND;
    v_start := v_start - INTERVAL '99 01:00:00.0' DAY TO SECOND;
    v_start := v_start - INTERVAL '68 01:00:00.0' DAY TO SECOND;
    select systimestamp into v_end from dual;
    v_sum := 0;
    LOOP
    EXIT WHEN v_start > v_end;
    v_intermediar := v_start + INTERVAL '0 01:00:00.0' DAY TO SECOND;
    v_aux := f_livrari('profit', p_oras, v_start, v_intermediar);
    v_adun := v_aux;
    v_sum := v_sum + v_adun;
    v_start := v_start + INTERVAL '0 01:00:00.0' DAY TO SECOND;
    END LOOP;
    return v_sum;
END;
/

CREATE OR REPLACE FUNCTION f_profit_anual_total
RETURN FLOAT AS
CURSOR lista_orase IS
  SELECT distinct(nume) FROM oras;
v_sum FLOAT;
v_nume VARCHAR2(1000);
v_adun FLOAT;
BEGIN
    v_sum := 0;
    OPEN lista_orase;
    LOOP
        FETCH lista_orase INTO v_nume;
        EXIT WHEN lista_orase%NOTFOUND;
        v_adun := f_profit_interval_anual(v_nume);
        v_sum := v_sum + v_adun;
    END LOOP;
    CLOSE lista_orase;
    return v_sum;
END;
/
CREATE OR REPLACE FUNCTION f_livrari_apelare(p_oras VARCHAR2, p_start TIMESTAMP, p_end TIMESTAMP)
RETURN varchar2 AS
v_contor INT;
v_s TIMESTAMP;
v_e TIMESTAMP;
v_ceva VARCHAR2(1000);
BEGIN
  v_ceva := 'bima';
  v_s := p_start;
  v_e := p_end;
  v_contor := 1;
  LOOP
  EXIT WHEN v_contor = 0;
  v_s := v_s + interval '1' minute;
  SELECT EXTRACT(MINUTE  FROM v_s) INto v_contor FROM DUAL;
  END LOOP;
  v_e := v_s;
  v_s := v_s  - INTERVAL '0 01:00:00.0' DAY TO SECOND;
  DBMS_OUTPUT.PUT_LINE(v_e);
  DBMS_OUTPUT.PUT_LINE(v_s);
  return f_livrari('traseu', p_oras, v_s, v_e);
END; 
/
CREATE OR REPLACE FUNCTION f_livrari_apelare_profit(p_oras VARCHAR2, p_start TIMESTAMP, p_end TIMESTAMP)
RETURN varchar2 AS
v_contor INT;
v_s TIMESTAMP;
v_e TIMESTAMP;
v_ceva VARCHAR2(1000);
BEGIN
  v_ceva := 'bima';
  v_s := p_start;
  v_e := p_end;
  v_contor := 1;
  LOOP
  EXIT WHEN v_contor = 0;
  v_s := v_s + interval '1' minute;
  SELECT EXTRACT(MINUTE  FROM v_s) INto v_contor FROM DUAL;
  END LOOP;
  v_e := v_s;
  v_s := v_s  - INTERVAL '0 01:00:00.0' DAY TO SECOND;
  DBMS_OUTPUT.PUT_LINE(v_e);
  DBMS_OUTPUT.PUT_LINE(v_s);
  return f_livrari('profit', p_oras, v_s, v_e);
END; 
/
/
CREATE OR REPLACE PROCEDURE inserare (id_client IN INT, nume_utilizator IN VARCHAR2, nume IN VARCHAR2, prenume IN VARCHAR2, telefon IN VARCHAR2, oras IN VARCHAR2, adresa IN VARCHAR2, email IN VARCHAR2, sex IN VARCHAR2, parola IN VARCHAR2) AS
BEGIN
   INSERT INTO clienti VALUES (id_client, nume_utilizator, nume, prenume, telefon, oras, adresa, email, sex, parola, systimestamp);
END;
