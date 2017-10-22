DROP FUNCTION IF EXISTS bd_sisvac.FinPeriodo;
#----------------------------- EJECUTAR POR SEPARADO---------------------
CREATE FUNCTION bd_sisvac.FinPeriodo ( fechaInicio date ) 
RETURNS date
BEGIN
  DECLARE fechaPeriodo date;
  DECLARE resultado date;
   IF (((to_days(now()) - to_days(date_format(fechaInicio,'%Y-%m-%d'))) >= 0) and 
      ((to_days(now()) - to_days((date_format(fechaInicio,'%Y-%m-%d') - interval 1 day))) < 365) and 
      (date_format(fechaInicio,'%Y') = date_format(now(),'%Y')))    
   THEN
    SET fechaPeriodo =  date_format(fechaInicio,concat(date_format(now(),'%Y'),'-%m-%d'));
   ELSEIF (((to_days(now()) - to_days(date_format(fechaInicio,'%Y-%m-%d'))) >= 0) and 
          ((to_days(now()) - to_days((date_format(fechaInicio,'%Y-%m-%d') - interval 1 day))) < 365) and 
          (date_format(fechaInicio,'%Y') <> date_format(now(),'%Y'))) 
    THEN 
     SET fechaPeriodo = fechaInicio;
    ELSEIF (((to_days(date_format(fechaInicio,concat(date_format(now(),'%Y'),'-%m-%d'))) - to_days(now())) <= 0) and 
           (date_format(fechaInicio,'%Y') <> date_format(now(),'%Y')))                   
    THEN 
      SET fechaPeriodo = date_format(fechaInicio,concat(date_format(now(),'%Y'),'-%m-%d'));  
    ELSEIF  (((to_days(date_format(fechaInicio,concat(date_format(now(),'%Y'),'-%m-%d'))) - to_days(now())) > 1) and 
            (date_format(fechaInicio,'%Y') < date_format(now(),'%Y')))
     THEN SET fechaPeriodo = date_format(fechaInicio,concat((date_format(now(),'%Y') - 1),'-%m-%d')); 
     END IF;
     SET resultado = fechaPeriodo + interval 1 year - interval 1 day;
  RETURN resultado;
END
              
                 
                  
                         