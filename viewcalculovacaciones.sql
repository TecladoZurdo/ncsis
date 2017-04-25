drop view viewcalculovacaciones;
create view viewcalculovacaciones as
SELECT 
        `fun`.`Fun_Apellidos` AS `Fun_Apellidos`,
        `fun`.`Fun_Nombres` AS `Fun_Nombres`,
        (CASE
            WHEN ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) >= 366) THEN DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2016-%m-%d')
            ELSE DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d')
        END) AS `iniperiodo`,
        (CASE
            WHEN ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) >= 366) THEN (DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2017-%m-%d') - INTERVAL 1 DAY)
            ELSE (DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2016-%m-%d') - INTERVAL 1 DAY)
        END) AS `finperiodo`,
        DATE_FORMAT(NOW(), '%Y-%m-%d') AS `fechaactual`,
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
        END) AS `antiguedad`,
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
        ELSE (CASE
		    WHEN
                ((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) >= 366)
            THEN
                ROUND((((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2016-%m-%d') - INTERVAL 1 DAY))) * 30) / 365),
                        2)
            ELSE ROUND((((TO_DAYS(NOW()) - TO_DAYS((DATE_FORMAT(`fun`.`Fun_FechaIngreso`, '2015-%m-%d') - INTERVAL 1 DAY))) * 30) / 365),
                    2)
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
        END)) AS `total`
    FROM
        `funcionario` `fun`
    WHERE
        (`fun`.`Fun_Estado` = 'activo') #and Fun_Id in (572,573)