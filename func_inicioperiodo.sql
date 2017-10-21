DROP FUNCTION IF EXISTS bd_sisvac.InicioPeriodo;
CREATE FUNCTION bd_sisvac.InicioPeriodo ( fechaInicio date ) 
RETURNS date
BEGIN
  DECLARE fechaPeriodo date;
   IF   (((to_days(now()) - to_days(date_format(fechaInicio,
                              '%Y-%m-%d'))) >= 0) and ((to_days(now()) - to_days((date_format(fechaInicio,
                                  '%Y-%m-%d') - interval 1 day))) < 365) and (date_format(fechaInicio,
                      '%Y') = date_format(now(),
                      '%Y')))  THEN
    SET fechaPeriodo =  date_format(fechainicio,concat(date_format(now(),'%Y'),'-%m-%d'));
     ELSEIF 
          (((to_days(now()) - to_days(date_format(fechainicio,
                                 '%Y-%m-%d'))) >= 0) and ((to_days(now()) - to_days((date_format(fechainicio,
                                     '%Y-%m-%d') - interval 1 day))) < 365) and (date_format(fechainicio,
                         '%Y') <> date_format(now(),
                         '%Y'))) then SET fechaPeriodo =fechainicio; 
     ELSEIF                    
          (((to_days(date_format(fechaInicio,
                                 concat(date_format(now(),
                                         '%Y'),
                                     '-%m-%d'))) - to_days(now())) <= 0) and (date_format(fechaInicio,
                         '%Y') <> date_format(now(),
                         '%Y'))) then SET fechaPeriodo = date_format(fechaInicio,
                 concat(date_format(now(),
                         '%Y'),
                     '-%m-%d')); 
      ELSEIF (((to_days(date_format(fechaInicio,
                                 concat(date_format(now(),
                                         '%Y'),
                                     '-%m-%d'))) - to_days(now())) > 1) and (date_format(fechaInicio,
                         '%Y') < date_format(now(),
                         '%Y'))) then SET fechaPeriodo = date_format(fechaInicio,
                 concat((date_format(now(),
                             '%Y') - 1),
                     '-%m-%d'));
   END IF;
   
  RETURN fechaPeriodo;
END
 


