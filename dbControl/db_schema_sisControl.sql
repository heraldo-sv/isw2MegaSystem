--=============================================================================
-- PROGRAM NAME: db_schema_sisControl.sql
-------------------------------------------------------------------------------
-- DESCRIPTION:
-- ESQUEMA GENERAL DE LA BASE DE DATOS RELACIONAL dbcontrol QUE INCLUYE
-- TODOS LOS ELEMENTOS BASE PARA LA OPERATIVIDAD DE LA APLICACIÓN.
-------------------------------------------------------------------------------
-- DATE            ACTION       ANALYST                COMMENTS
-- 26-AGO-2017     CREACIÓN     REY ERALDO DEL VALLE   VERSIÓN INICIAL
--=============================================================================

-- Create a new database called 'dbcontrol'
-- Connect to the 'master' database to run this snippet
USE master
GO
-- Create the new database if it does not exist already
IF NOT EXISTS (
    SELECT name
        FROM sys.databases
        WHERE name = N'dbcontrol'
)
CREATE DATABASE dbcontrol
GO