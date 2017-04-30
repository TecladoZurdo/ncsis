#drop view viewcalculovacaciones;
#create view viewcalculovacaciones as
SELECT 
        `fun`.`Fun_Apellidos` AS `Fun_Apellidos`,
        `fun`.`Fun_Nombres` AS `Fun_Nombres`,
        `fun`.`Fun_FechaIngreso`,
        (CASE
			WHEN  #menor de un year ACTUAL
            to_days(now())-to_days(date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d'))>=0 
            and
            to_days(now())-to_days(date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d') - interval 1 DAY)<365 
            and 
            date_format(`fun`.`Fun_FechaIngreso`,'%Y') = date_format(now(),'%Y') 
            THEN 
            date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y'),'-%m-%d'))
            WHEN #
            to_days(now())-to_days(date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d'))>=0
            and
            to_days(now())-to_days(date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d') - interval 1 DAY)<365 
            and
            date_format(`fun`.`Fun_FechaIngreso`,'%Y') <> date_format(now(),'%Y') 
            THEN 
            `fun`.`Fun_FechaIngreso`
            WHEN # fecha formateada UN YEAR ACTUAL
            to_days(date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y'),'-%m-%d')))-to_days(now())<0
            and 
            date_format(`fun`.`Fun_FechaIngreso`,'%Y') <> date_format(now(),'%Y') 
            THEN 
            date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y'),'-%m-%d'))            
            WHEN # fecha formateada contenido 
            to_days(date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y'),'-%m-%d')))-to_days(now())>1
            and 
            date_format(`fun`.`Fun_FechaIngreso`,'%Y') < date_format(now(),'%Y') 
            THEN 
            date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y')-1,'-%m-%d'))
            
        END) 
        AS `iniperiodo`,

        (CASE
			WHEN  #menor de un year ACTUAL
            to_days(now())-to_days(date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d'))>=0 
            and
            to_days(now())-to_days(date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d') - interval 1 DAY)<365 
            and 
            date_format(`fun`.`Fun_FechaIngreso`,'%Y') = date_format(now(),'%Y') 
            THEN 
            date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y'),'-%m-%d'))
            WHEN #
            to_days(now())-to_days(date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d'))>=0
            and
            to_days(now())-to_days(date_format(`fun`.`Fun_FechaIngreso`,'%Y-%m-%d') - interval 1 DAY)<365 
            and
            date_format(`fun`.`Fun_FechaIngreso`,'%Y') <> date_format(now(),'%Y') 
            THEN 
            `fun`.`Fun_FechaIngreso`
            WHEN # fecha formateada UN YEAR ACTUAL
            to_days(date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y'),'-%m-%d')))-to_days(now())<0
            and 
            date_format(`fun`.`Fun_FechaIngreso`,'%Y') <> date_format(now(),'%Y') 
            THEN 
            date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y'),'-%m-%d'))            
            WHEN # fecha formateada contenido 
            to_days(date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y'),'-%m-%d')))-to_days(now())>1
            and 
            date_format(`fun`.`Fun_FechaIngreso`,'%Y') < date_format(now(),'%Y') 
            THEN 
            date_format(`fun`.`Fun_FechaIngreso`,concat(date_format(now(),'%Y')-1,'-%m-%d'))
            
        END)+ interval 1 year - interval 1 day
        
        AS `finperiodo`,
        
        DATE_FORMAT(NOW(), '%Y-%m-%d') AS `fechaactual`,
        (CASE WHEN losep=1
         then 0
         else 
        (CASE
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 5)
            THEN
                1
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 6)
            THEN
                2
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 7)
            THEN
                3
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 8)
            THEN
                4
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 9)
            THEN
                5
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 10)
            THEN
                6
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 11)
            THEN
                7
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 12)
            THEN
                8
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 13)
            THEN
                9
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 14)
            THEN
                10
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 15)
            THEN
                11
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 16)
            THEN
                12
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) = 17)
            THEN
                13
            WHEN
                (TIMESTAMPDIFF(YEAR,
                    DATE_FORMAT(CAST(`fun`.`Fun_FechaIngreso` AS DATE),
                            '%Y/%m/%d'),
                    DATE_FORMAT(NOW(), '%Y/%m/%d')) >= 18)
            THEN
                14
            ELSE 0
        END) 
        end)
        AS `antiguedad`,
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
        (CASE
            WHEN
                (((CASE
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
                END) >= 7)
                    AND ((CASE
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
                END) <= 14))
            THEN
                ((CASE
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
                END) - 2)
            WHEN
                (((CASE
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
                END) > 14)
                    AND ((CASE
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
                END) <= 22))
            THEN
                ((CASE
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
                END) - 4)
            ELSE (CASE
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
            END)
        END) AS `descuentoslaborables`,
        (CASE 
        WHEN LOSEP= 1
         THEN 'SI'
         ELSE 'NO'
		END
        ) AS loep,
        # DIAS DEVENGADOS SON LOS DIAS QUE DESDE QUE INICIO TIENE A FAVOR PARA USAR EN VACACIONES
        ( CASE 
        WHEN LOSEP = 0 THEN
        (CASE
		    WHEN
                ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) >= 366)
            THEN
                ROUND((((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2016-%m-%d') - INTERVAL 1 DAY))) * 15) / 365),
                        2)
            ELSE ROUND((((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) * 15) / 365),
                    2)
        END) 
        ELSE (
          CASE
		    WHEN #si no supera un anio o es igual a un anio
                ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '%y-%m-%d') - INTERVAL 1 DAY ))) <= 
                 TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '%y-%m-%d') + INTERVAL 1 YEAR)))
            THEN
                ROUND(
                ( (
                # DIA DE INGRESO
                (30 -DATE_FORMAT(`fun`.`Fun_FechaIngreso`,'%d')+1) +
                #MESES TRANCURRIDO EN EL ANIO MENOS MES INICIO * 30 
                ((timestampdiff(month,`fun`.`Fun_FechaIngreso`,curdate())-1)*30)+
                #((DATE_FORMAT(NOW(),'%m') - DATE_FORMAT(`fun`.`Fun_FechaIngreso`,'%m')-1)*30) +
                #FECHA ACTUAL DIAS
                (CASE   WHEN (DATE_FORMAT(NOW(),'%d') < 30)
                 THEN DATE_FORMAT(NOW(),'%d')
                 ELSE 30
                 END)
                )*30/360), 
                2)
                        
            ELSE ROUND((((TO_DAYS(NOW()) - TO_DAYS((`fun`.`Fun_FechaIngreso`- INTERVAL 1 DAY))) * 1) / 1), 2)
        END
        )
        END
        ) AS `diasdevengados`,
        (CASE
            WHEN
                ((SELECT 
                        COUNT(0)
                    FROM
                        `calculo`
                    WHERE
                        (`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) = 1)
            THEN
                (SELECT 
                        `cal1`.`Cal_DiasCal`
                    FROM
                        `calculo` `cal1`
                    WHERE
                        (`cal1`.`Cal_Id` = (SELECT 
                                MAX(`calculo`.`Cal_Id`)
                            FROM
                                `calculo`
                            WHERE
                                (`calculo`.`Fun_Id` = `fun`.`Fun_Id`))))
            WHEN
                ((SELECT 
                        COUNT(0)
                    FROM
                        `calculo`
                    WHERE
                        (`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) = 2)
            THEN
                (SELECT 
                        `cal1`.`Cal_SalCal`
                    FROM
                        `calculo` `cal1`
                    WHERE
                        (`cal1`.`Cal_Id` = (SELECT 
                                MAX(`calculo`.`Cal_Id`)
                            FROM
                                `calculo`
                            WHERE
                                (`calculo`.`Fun_Id` = `fun`.`Fun_Id`))))
            ELSE 0
        END) AS `saldoanterior`,
        (CASE
            WHEN
                ((SELECT 
                        COUNT(0)
                    FROM
                        `calculo`
                    WHERE
                        (`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) = 1)
            THEN
                (SELECT 
                        `cal1`.`Cal_DiasLab`
                    FROM
                        `calculo` `cal1`
                    WHERE
                        (`cal1`.`Cal_Id` = (SELECT 
                                MAX(`calculo`.`Cal_Id`)
                            FROM
                                `calculo`
                            WHERE
                                (`calculo`.`Fun_Id` = `fun`.`Fun_Id`))))
            WHEN
                ((SELECT 
                        COUNT(0)
                    FROM
                        `calculo`
                    WHERE
                        (`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) >= 2)
            THEN
                (SELECT 
                        `cal1`.`Cal_SalLab`
                    FROM
                        `calculo` `cal1`
                    WHERE
                        (`cal1`.`Cal_Id` = (SELECT 
                                MAX(`calculo`.`Cal_Id`)
                            FROM
                                `calculo`
                            WHERE
                                (`calculo`.`Fun_Id` = `fun`.`Fun_Id`))))
            ELSE 0
        END) AS `saldoanteriorLab`,
        ((CASE
            WHEN
                ((SELECT 
                        COUNT(0)
                    FROM
                        `calculo`
                    WHERE
                        (`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) = 1)
            THEN
                (SELECT 
                        `cal1`.`Cal_DiasCal`
                    FROM
                        `calculo` `cal1`
                    WHERE
                        (`cal1`.`Cal_Id` = (SELECT 
                                MAX(`calculo`.`Cal_Id`)
                            FROM
                                `calculo`
                            WHERE
                                (`calculo`.`Fun_Id` = `fun`.`Fun_Id`))))
            WHEN
                ((SELECT 
                        COUNT(0)
                    FROM
                        `calculo`
                    WHERE
                        (`calculo`.`Fun_Id` = `fun`.`Fun_Id`)) >= 2)
            THEN
                (SELECT 
                        `cal1`.`Cal_SalCal`
                    FROM
                        `calculo` `cal1`
                    WHERE
                        (`cal1`.`Cal_Id` = (SELECT 
                                MAX(`calculo`.`Cal_Id`)
                            FROM
                                `calculo`
                            WHERE
                                (`calculo`.`Fun_Id` = `fun`.`Fun_Id`))))
            ELSE 0
        END) - (CASE
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
        END)) AS `total`,
        Fun_Id
    FROM
        `funcionario` `fun`
    WHERE
        (`fun`.`Fun_Estado` = 'activo') #and Fun_Id in (572,573,574,60,521,21)