#drop view viewcalculovacaciones;
#create view viewcalculovacaciones as
select
     `fun`.`Fun_Apellidos` AS `Fun_Apellidos`,
    `fun`.`Fun_Nombres` AS `Fun_Nombres`,
    `fun`.`Fun_FechaIngreso` AS `Fun_FechaIngreso`, 
     date_format(InicioPeriodo(Fun_FechaIngreso),'%Y-%m-%d') as `iniperiodo`, 
#---------------------------------------------- FIN DE PERIODO --------------------------------------------------------------
        (((case when (((to_days(now()) - to_days(date_format(`fun`.`Fun_FechaIngreso`,
                                    '%Y-%m-%d'))) >= 0) and ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                        '%Y-%m-%d') - interval 1 day))) < 365) and (date_format(`fun`.`Fun_FechaIngreso`,
                            '%Y') = date_format(now(),
                            '%Y'))) then date_format(`fun`.`Fun_FechaIngreso`,
                    concat(date_format(now(),
                            '%Y'),
                        '-%m-%d')) when (((to_days(now()) - to_days(date_format(`fun`.`Fun_FechaIngreso`,
                                    '%Y-%m-%d'))) >= 0) and ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                        '%Y-%m-%d') - interval 1 day))) < 365) and (date_format(`fun`.`Fun_FechaIngreso`,
                            '%Y') <> date_format(now(),
                            '%Y'))) then `fun`.`Fun_FechaIngreso` when (((to_days(date_format(`fun`.`Fun_FechaIngreso`,
                                    concat(date_format(now(),
                                            '%Y'),
                                        '-%m-%d'))) - to_days(now())) <= 0) and (date_format(`fun`.`Fun_FechaIngreso`,
                            '%Y') <> date_format(now(),
                            '%Y'))) then date_format(`fun`.`Fun_FechaIngreso`,
                    concat(date_format(now(),
                            '%Y'),
                        '-%m-%d')) when (((to_days(date_format(`fun`.`Fun_FechaIngreso`,
                                    concat(date_format(now(),
                                            '%Y'),
                                        '-%m-%d'))) - to_days(now())) > 1) and (date_format(`fun`.`Fun_FechaIngreso`,
                            '%Y') < date_format(now(),
                            '%Y'))) then date_format(`fun`.`Fun_FechaIngreso`,
                    concat((date_format(now(),
                                '%Y') - 1),
                        '-%m-%d')) end) + interval 1 year) - interval 1 day) AS `finperiodo`,
    date_format(now(),
        '%Y-%m-%d') AS `fechaactual`,
#-----------------------------------------------------ANTIGUEDAD   ----------------------------------------------------
        (case when (`fun`.`losep` = 1) then 0 else (case when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 5) then 1 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 6) then 2 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 7) then 3 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 8) then 4 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 9) then 5 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 10) then 6 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 11) then 7 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 12) then 8 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 13) then 9 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 14) then 10 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 15) then 11 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 16) then 12 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) = 17) then 13 when (timestampdiff(YEAR,
                    date_format(cast(`fun`.`Fun_FechaIngreso` as date),
                        '%Y/%m/%d'),
                    date_format(now(),
                        '%Y/%m/%d')) >= 18) then 14 else 0 end) end) AS `antiguedad`,  
#------------------------------------------ DESCUENTOS ---------------------------------------------------------------------------------
(CASE
            WHEN
                ISNULL((SELECT 
                                SUM(`per`.`Per_ValorCal`)
                            FROM
                                (`permisos` `per`
                                JOIN `tipopermiso` `tp` ON (((`per`.`Tiper_Id` = `tp`.`Tiper_Id`)
                                    AND (`tp`.`descuentoVacaciones` = 1))))
                            WHERE
                                ((`per`.`Fun_Id` = `fun`.`Fun_Id`)
                                    AND (`per`.`Per_FechaInicio` BETWEEN CONVERT( (CASE
                                    WHEN ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) >= 366) THEN DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2016-%m-%d')
                                    ELSE DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d')
                                END) USING UTF8) AND CONVERT( (CASE
                                    WHEN ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) >= 366) THEN (DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2017-%m-%d') - INTERVAL 1 DAY)
                                    ELSE (DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2016-%m-%d') - INTERVAL 1 DAY)
                                END) USING UTF8)))))
            THEN
                0
            ELSE (SELECT 
                    SUM(`per`.`Per_ValorCal`)
                FROM
                    (`permisos` `per`
                    JOIN `tipopermiso` `tp` ON (((`per`.`Tiper_Id` = `tp`.`Tiper_Id`)
                        AND (`tp`.`descuentoVacaciones` = 1))))
                WHERE
                    ((`per`.`Fun_Id` = `fun`.`Fun_Id`)
                        AND (`per`.`Per_FechaInicio` BETWEEN CONVERT( (CASE
                        WHEN ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) >= 366) THEN DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2016-%m-%d')
                        ELSE DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d')
                    END) USING UTF8) AND CONVERT( (CASE
                        WHEN ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) >= 366) THEN (DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2017-%m-%d') - INTERVAL 1 DAY)
                        ELSE (DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2016-%m-%d') - INTERVAL 1 DAY)
                    END) USING UTF8))))
        END) AS `descuentos`,                             
#------------------------------------------ DESCUENTO LABORALES--------------------------------------------------------------------------
        (case when (((case when isnull((
                        select
                             sum(`per`.`Per_ValorCal`) 
                        from (`bd_sisvac`.`permisos` `per` join
                                 `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                        where
                             ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                                '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                                '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                                '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2016-%m-%d') - interval 1 day) end) using utf8))))) then 0 else (
                    select
                         sum(`per`.`Per_ValorCal`) 
                    from (`bd_sisvac`.`permisos` `per` join
                             `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                    where
                         ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                            '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') - interval 1 day) end) using utf8)))) end) >= 7) and ((case when isnull((
                        select
                             sum(`per`.`Per_ValorCal`) 
                        from (`bd_sisvac`.`permisos` `per` join
                                 `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                        where
                             ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                                '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                                '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                                '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2016-%m-%d') - interval 1 day) end) using utf8))))) then 0 else (
                    select
                         sum(`per`.`Per_ValorCal`) 
                    from (`bd_sisvac`.`permisos` `per` join
                             `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                    where
                         ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                            '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') - interval 1 day) end) using utf8)))) end) <= 14)) then ((case when isnull((
                    select
                         sum(`per`.`Per_ValorCal`) 
                    from (`bd_sisvac`.`permisos` `per` join
                             `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                    where
                         ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                            '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') - interval 1 day) end) using utf8))))) then 0 else (
                select
                     sum(`per`.`Per_ValorCal`) 
                from (`bd_sisvac`.`permisos` `per` join
                         `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                where
                     ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                        '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                        '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                        '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                        '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                            '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') - interval 1 day) end) using utf8)))) end) - 2) when (((case when isnull((
                        select
                             sum(`per`.`Per_ValorCal`) 
                        from (`bd_sisvac`.`permisos` `per` join
                                 `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                        where
                             ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                                '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                                '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                                '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2016-%m-%d') - interval 1 day) end) using utf8))))) then 0 else (
                    select
                         sum(`per`.`Per_ValorCal`) 
                    from (`bd_sisvac`.`permisos` `per` join
                             `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                    where
                         ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                            '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') - interval 1 day) end) using utf8)))) end) > 14) and ((case when isnull((
                        select
                             sum(`per`.`Per_ValorCal`) 
                        from (`bd_sisvac`.`permisos` `per` join
                                 `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                        where
                             ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                                '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                                '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                                '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2016-%m-%d') - interval 1 day) end) using utf8))))) then 0 else (
                    select
                         sum(`per`.`Per_ValorCal`) 
                    from (`bd_sisvac`.`permisos` `per` join
                             `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                    where
                         ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                            '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') - interval 1 day) end) using utf8)))) end) <= 22)) then ((case when isnull((
                    select
                         sum(`per`.`Per_ValorCal`) 
                    from (`bd_sisvac`.`permisos` `per` join
                             `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                    where
                         ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                            '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                            '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                                '2016-%m-%d') - interval 1 day) end) using utf8))))) then 0 else (
                select
                     sum(`per`.`Per_ValorCal`) 
                from (`bd_sisvac`.`permisos` `per` join
                         `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                where
                     ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                        '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                        '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                        '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                        '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                            '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') - interval 1 day) end) using utf8)))) end) - 4) else (case when isnull((
                select
                     sum(`per`.`Per_ValorCal`) 
                from (`bd_sisvac`.`permisos` `per` join
                         `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                where
                     ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                        '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                        '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                        '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                        '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                            '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') - interval 1 day) end) using utf8))))) then 0 else (
            select
                 sum(`per`.`Per_ValorCal`) 
            from (`bd_sisvac`.`permisos` `per` join
                     `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
            where
                 ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                    '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                    '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                        '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                        '2016-%m-%d') - interval 1 day) end) using utf8)))) end) end) AS `descuentoslaborables`,   
# --------------------------------- LOEP ---------------------------------------------------------------------------------------------                                        
        (case when (`fun`.`losep` = 1) then 'SI' else 'NO' end) AS `loep`,      
# ---------------------------------- DIAS DEVENGADOS -----------------------------------------------------------------------------------
(case when (`fun`.`losep` = 1) then  (case when ((to_days(now()) - to_days((date_format(InicioPeriodo(Fun_FechaIngreso),'%y-%m-%d') - interval 1 day))) 
                                                          <= 
                                                to_days((date_format(InicioPeriodo(Fun_FechaIngreso),'%y-%m-%d') + interval 1 year))) 
                                           then round(((((((30 - date_format(InicioPeriodo(Fun_FechaIngreso),'%d')) + 1) + 
                                                        ((timestampdiff(MONTH,InicioPeriodo(Fun_FechaIngreso), curdate()) - 1) * 30)) + 
                                                        (case when (date_format(now(),'%d') < 30) then date_format(now(),'%d') else 30 end)) * 30) /360), 2) 
                                           else "error" #round((((to_days(now()) - to_days((InicioPeriodo(Fun_FechaIngreso) - interval 1 day))) * 1) / 1),2)
                                      end)
                               else (case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d') - interval 1 day))) >= 366) 
                                          then  "aqui"
                                                #round(((((((30 - date_format(InicioPeriodo(Fun_FechaIngreso),'%d')) + 1) + 
                                                #((timestampdiff(MONTH,InicioPeriodo(Fun_FechaIngreso), curdate()) - 1) * 30)) + 
                                                #(case when (date_format(now(),'%d') < 30) then date_format(now(),'%d') else 30 end)) * 15) /360), 2) 
                                          #round((((to_days(now()) - to_days((date_format(InicioPeriodo(Fun_FechaIngreso),'%Y-%m-%d') - interval 1 day))) * 15) /360),2)
                                          else "error" #round((((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d') - interval 1 day))) * 15) /360),2) 
                                     end)  
                end) AS `diasdevengados`,        
#----------------------- SALDO ANTERIOR -----------------------------------------------------------------------------------------------                
        (case when ((
            select
                 count(0) 
            from `bd_sisvac`.`calculo` 
            where
                 (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) = 1) then (
        select
             `cal1`.`Cal_DiasCal` 
        from `bd_sisvac`.`calculo` `cal1` 
        where
             (`cal1`.`Cal_Id` = (
                select
                     max(`bd_sisvac`.`calculo`.`Cal_Id`) 
                from `bd_sisvac`.`calculo` 
                where
                     (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)))) when ((
            select
                 count(0) 
            from `bd_sisvac`.`calculo` 
            where
                 (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) = 2) then (
        select
             `cal1`.`Cal_SalCal` 
        from `bd_sisvac`.`calculo` `cal1` 
        where
             (`cal1`.`Cal_Id` = (
                select
                     max(`bd_sisvac`.`calculo`.`Cal_Id`) 
                from `bd_sisvac`.`calculo` 
                where
                     (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)))) else 0 end) AS `saldoanterior`, 
# -------------------------- SALDO ANTERIOR LAB ----------------------------------------------------------------------                     
        (case when ((
            select
                 count(0) 
            from `bd_sisvac`.`calculo` 
            where
                 (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) = 1) then (
        select
             `cal1`.`Cal_DiasLab` 
        from `bd_sisvac`.`calculo` `cal1` 
        where
             (`cal1`.`Cal_Id` = (
                select
                     max(`bd_sisvac`.`calculo`.`Cal_Id`) 
                from `bd_sisvac`.`calculo` 
                where
                     (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)))) when ((
            select
                 count(0) 
            from `bd_sisvac`.`calculo` 
            where
                 (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) >= 2) then (
        select
             `cal1`.`Cal_SalLab` 
        from `bd_sisvac`.`calculo` `cal1` 
        where
             (`cal1`.`Cal_Id` = (
                select
                     max(`bd_sisvac`.`calculo`.`Cal_Id`) 
                from `bd_sisvac`.`calculo` 
                where
                     (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)))) else 0 end) AS `saldoanteriorLab`,  
#------------------------------------------- TOTAL-----------------------------------------------------------------------------                     
        ((case when ((
                select
                     count(0) 
                from `bd_sisvac`.`calculo` 
                where
                     (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) = 1) then (
            select
                 `cal1`.`Cal_DiasCal` 
            from `bd_sisvac`.`calculo` `cal1` 
            where
                 (`cal1`.`Cal_Id` = (
                    select
                         max(`bd_sisvac`.`calculo`.`Cal_Id`) 
                    from `bd_sisvac`.`calculo` 
                    where
                         (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)))) when ((
                select
                     count(0) 
                from `bd_sisvac`.`calculo` 
                where
                     (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) >= 2) then (
            select
                 `cal1`.`Cal_SalCal` 
            from `bd_sisvac`.`calculo` `cal1` 
            where
                 (`cal1`.`Cal_Id` = (
                    select
                         max(`bd_sisvac`.`calculo`.`Cal_Id`) 
                    from `bd_sisvac`.`calculo` 
                    where
                         (`bd_sisvac`.`calculo`.`Fun_Id` = `fun`.`Fun_Id`)))) else 0 end) - (case when isnull((
                select
                     sum(`per`.`Per_ValorCal`) 
                from (`bd_sisvac`.`permisos` `per` join
                         `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
                where
                     ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                        '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                        '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                        '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                        '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                            '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                            '2016-%m-%d') - interval 1 day) end) using utf8))))) then 0 else (
            select
                 sum(`per`.`Per_ValorCal`) 
            from (`bd_sisvac`.`permisos` `per` join
                     `bd_sisvac`.`tipopermiso` `tp` on(((`per`.`Tiper_Id` = `tp`.`Tiper_Id`) and (`tp`.`descuentoVacaciones` = 1)))) 
            where
                 ((`per`.`Fun_Id` = `fun`.`Fun_Id`) and (`per`.`Per_FechaInicio` between convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2015-%m-%d') - interval 1 day))) >= 366) then date_format(`fun`.`Fun_FechaIngreso`,
                                    '2016-%m-%d') else date_format(`fun`.`Fun_FechaIngreso`,
                                    '2015-%m-%d') end) using utf8) and convert((case when ((to_days(now()) - to_days((date_format(`fun`.`Fun_FechaIngreso`,
                                                    '2015-%m-%d') - interval 1 day))) >= 366) then (date_format(`fun`.`Fun_FechaIngreso`,
                                        '2017-%m-%d') - interval 1 day) else (date_format(`fun`.`Fun_FechaIngreso`,
                                        '2016-%m-%d') - interval 1 day) end) using utf8)))) end)) AS `total`, 
#-------------------------------------- FUNCIONARIO ID -----------------------------------------------------------------------                                        
    `fun`.`Fun_Id` AS `Fun_Id` 
from `bd_sisvac`.`funcionario` `fun` 
where
     (`fun`.`Fun_Estado` = 'activo')   and Fun_Id=182
