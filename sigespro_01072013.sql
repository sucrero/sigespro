--
-- PostgreSQL database dump
--

-- Started on 2013-07-01 07:00:57

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

--
-- TOC entry 392 (class 2612 OID 16386)
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: postgres
--

CREATE PROCEDURAL LANGUAGE plpgsql;


ALTER PROCEDURAL LANGUAGE plpgsql OWNER TO postgres;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1579 (class 1259 OID 52973)
-- Dependencies: 6
-- Name: anteproyecto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anteproyecto (
    idantep integer NOT NULL,
    idjefe integer,
    idperiodo integer,
    idproblema integer,
    idgrupo integer,
    iddiagnostico integer,
    idpersona integer,
    iddocente integer,
    doc_iddocente integer,
    idpnf integer,
    nomantep character varying(255),
    objantep character varying(255),
    trayectoante character varying(3),
    trimestreante character varying(3),
    fechaante date,
    observante character varying(255),
    statusante character varying(20),
    codantep character varying(17)
);


ALTER TABLE public.anteproyecto OWNER TO postgres;

--
-- TOC entry 1580 (class 1259 OID 52979)
-- Dependencies: 1579 6
-- Name: anteproyecto_idantep_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE anteproyecto_idantep_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.anteproyecto_idantep_seq OWNER TO postgres;

--
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 1580
-- Name: anteproyecto_idantep_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE anteproyecto_idantep_seq OWNED BY anteproyecto.idantep;


--
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 1580
-- Name: anteproyecto_idantep_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('anteproyecto_idantep_seq', 16, true);


--
-- TOC entry 1581 (class 1259 OID 52981)
-- Dependencies: 6
-- Name: comision_tecnica; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE comision_tecnica (
    idcomision integer NOT NULL,
    idpersona integer,
    iddocente integer,
    fecha_creacion date,
    obsercomision character varying(255),
    identificador character varying(3),
    codigocomision integer
);


ALTER TABLE public.comision_tecnica OWNER TO postgres;

--
-- TOC entry 1582 (class 1259 OID 52984)
-- Dependencies: 6 1581
-- Name: comision_tecnica_idcomision_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE comision_tecnica_idcomision_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.comision_tecnica_idcomision_seq OWNER TO postgres;

--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 1582
-- Name: comision_tecnica_idcomision_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE comision_tecnica_idcomision_seq OWNED BY comision_tecnica.idcomision;


--
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 1582
-- Name: comision_tecnica_idcomision_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comision_tecnica_idcomision_seq', 83, true);


--
-- TOC entry 1583 (class 1259 OID 52986)
-- Dependencies: 6
-- Name: comunidad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE comunidad (
    idcomuni integer NOT NULL,
    idparroquia integer,
    nomcomuni character varying(150),
    dircomuni character varying(90)
);


ALTER TABLE public.comunidad OWNER TO postgres;

--
-- TOC entry 1584 (class 1259 OID 52989)
-- Dependencies: 6 1583
-- Name: comunidad_idcomuni_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE comunidad_idcomuni_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.comunidad_idcomuni_seq OWNER TO postgres;

--
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 1584
-- Name: comunidad_idcomuni_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE comunidad_idcomuni_seq OWNED BY comunidad.idcomuni;


--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 1584
-- Name: comunidad_idcomuni_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comunidad_idcomuni_seq', 1, false);


--
-- TOC entry 1633 (class 1259 OID 53592)
-- Dependencies: 6
-- Name: consejo_comunal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE consejo_comunal (
    idconsejo integer NOT NULL,
    idsectorcomunidad integer,
    rifconsejo character varying(14),
    sicomconsejo character varying(8),
    feculteleccion date,
    nomconsejo character varying(255)
);


ALTER TABLE public.consejo_comunal OWNER TO postgres;

--
-- TOC entry 1632 (class 1259 OID 53590)
-- Dependencies: 1633 6
-- Name: consejo_comunal_idconsejo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE consejo_comunal_idconsejo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.consejo_comunal_idconsejo_seq OWNER TO postgres;

--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 1632
-- Name: consejo_comunal_idconsejo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE consejo_comunal_idconsejo_seq OWNED BY consejo_comunal.idconsejo;


--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 1632
-- Name: consejo_comunal_idconsejo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('consejo_comunal_idconsejo_seq', 1, false);


--
-- TOC entry 1585 (class 1259 OID 52991)
-- Dependencies: 6
-- Name: denuncia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE denuncia (
    iddenuncia integer NOT NULL,
    idusuario integer,
    descripdenuncia character varying(1000),
    tipodenuncia character varying(30),
    codtipo character varying(15),
    fechadenuncia timestamp with time zone,
    horadenuncia time without time zone
);


ALTER TABLE public.denuncia OWNER TO postgres;

--
-- TOC entry 1586 (class 1259 OID 52997)
-- Dependencies: 6 1585
-- Name: denuncia_iddenuncia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE denuncia_iddenuncia_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.denuncia_iddenuncia_seq OWNER TO postgres;

--
-- TOC entry 2183 (class 0 OID 0)
-- Dependencies: 1586
-- Name: denuncia_iddenuncia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE denuncia_iddenuncia_seq OWNED BY denuncia.iddenuncia;


--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 1586
-- Name: denuncia_iddenuncia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('denuncia_iddenuncia_seq', 1, false);


--
-- TOC entry 1587 (class 1259 OID 52999)
-- Dependencies: 6
-- Name: diagnostico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE diagnostico (
    iddiagnostico integer NOT NULL,
    idpersona integer,
    iddocente integer,
    idpnf integer,
    doc_iddocente integer,
    idsectorcomunidad integer,
    idgrupo integer,
    idperiodo integer,
    idjefe integer,
    nomconsejocomunal character varying(255),
    fechadiagnostico date,
    observaciondiagnostico character varying(255),
    trayectodiagnostico character varying(3),
    trimestrediagnostico character varying(3),
    descripdiagnostico character varying(255),
    statusdiagnostico character varying(20),
    coddiag character varying(17)
);


ALTER TABLE public.diagnostico OWNER TO postgres;

--
-- TOC entry 1588 (class 1259 OID 53005)
-- Dependencies: 6 1587
-- Name: diagnostico_iddiagnostico_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE diagnostico_iddiagnostico_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.diagnostico_iddiagnostico_seq OWNER TO postgres;

--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 1588
-- Name: diagnostico_iddiagnostico_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE diagnostico_iddiagnostico_seq OWNED BY diagnostico.iddiagnostico;


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 1588
-- Name: diagnostico_iddiagnostico_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('diagnostico_iddiagnostico_seq', 1, false);


--
-- TOC entry 1589 (class 1259 OID 53007)
-- Dependencies: 6
-- Name: docente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE docente (
    iddocente integer NOT NULL,
    idusuario integer,
    idpnf integer,
    idcomuni integer,
    ceddocente character varying(11),
    nomdocente character varying(25),
    apedocente character varying(25),
    sexdocente character varying(1),
    fnacimiento date,
    telefdocente character varying(11),
    gradoinstruccion character varying(50),
    profesion character varying(50),
    direccdocente character varying(100),
    maildocente character varying(50)
);


ALTER TABLE public.docente OWNER TO postgres;

--
-- TOC entry 1590 (class 1259 OID 53010)
-- Dependencies: 1589 6
-- Name: docente_iddocente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE docente_iddocente_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.docente_iddocente_seq OWNER TO postgres;

--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 1590
-- Name: docente_iddocente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE docente_iddocente_seq OWNED BY docente.iddocente;


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 1590
-- Name: docente_iddocente_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('docente_iddocente_seq', 1, true);


--
-- TOC entry 1591 (class 1259 OID 53012)
-- Dependencies: 6
-- Name: entdiag; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE entdiag (
    identdiag integer NOT NULL,
    iddiagnostico integer,
    nomentdiag character varying(100),
    ubientdiag character varying(50)
);


ALTER TABLE public.entdiag OWNER TO postgres;

--
-- TOC entry 1592 (class 1259 OID 53015)
-- Dependencies: 6 1591
-- Name: entdiag_identdiag_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE entdiag_identdiag_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.entdiag_identdiag_seq OWNER TO postgres;

--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 1592
-- Name: entdiag_identdiag_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE entdiag_identdiag_seq OWNED BY entdiag.identdiag;


--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 1592
-- Name: entdiag_identdiag_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('entdiag_identdiag_seq', 1, false);


--
-- TOC entry 1593 (class 1259 OID 53017)
-- Dependencies: 6
-- Name: entproy; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE entproy (
    identproy integer NOT NULL,
    idproyecto integer,
    nomentproy character varying(100),
    ubientproy character varying(50)
);


ALTER TABLE public.entproy OWNER TO postgres;

--
-- TOC entry 1594 (class 1259 OID 53020)
-- Dependencies: 1593 6
-- Name: entproy_identproy_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE entproy_identproy_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.entproy_identproy_seq OWNER TO postgres;

--
-- TOC entry 2191 (class 0 OID 0)
-- Dependencies: 1594
-- Name: entproy_identproy_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE entproy_identproy_seq OWNED BY entproy.identproy;


--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 1594
-- Name: entproy_identproy_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('entproy_identproy_seq', 1, false);


--
-- TOC entry 1595 (class 1259 OID 53022)
-- Dependencies: 6
-- Name: entreanteproy; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE entreanteproy (
    identreanteproy integer NOT NULL,
    idantep integer,
    nomentantproy character varying(100),
    ubientantproy character varying(50)
);


ALTER TABLE public.entreanteproy OWNER TO postgres;

--
-- TOC entry 1596 (class 1259 OID 53025)
-- Dependencies: 1595 6
-- Name: entreanteproy_identreanteproy_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE entreanteproy_identreanteproy_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.entreanteproy_identreanteproy_seq OWNER TO postgres;

--
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 1596
-- Name: entreanteproy_identreanteproy_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE entreanteproy_identreanteproy_seq OWNED BY entreanteproy.identreanteproy;


--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 1596
-- Name: entreanteproy_identreanteproy_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('entreanteproy_identreanteproy_seq', 1, false);


--
-- TOC entry 1597 (class 1259 OID 53027)
-- Dependencies: 6
-- Name: entregables; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE entregables (
    identregable integer NOT NULL,
    nombreentregable character varying(50),
    descripentregable character varying(255),
    tipoentregable character varying(15)
);


ALTER TABLE public.entregables OWNER TO postgres;

--
-- TOC entry 1598 (class 1259 OID 53030)
-- Dependencies: 1597 6
-- Name: entregables_identregable_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE entregables_identregable_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.entregables_identregable_seq OWNER TO postgres;

--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 1598
-- Name: entregables_identregable_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE entregables_identregable_seq OWNED BY entregables.identregable;


--
-- TOC entry 2196 (class 0 OID 0)
-- Dependencies: 1598
-- Name: entregables_identregable_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('entregables_identregable_seq', 1, false);


--
-- TOC entry 1599 (class 1259 OID 53032)
-- Dependencies: 6
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estado (
    idestado integer NOT NULL,
    descripestado character varying(50)
);


ALTER TABLE public.estado OWNER TO postgres;

--
-- TOC entry 1600 (class 1259 OID 53035)
-- Dependencies: 1599 6
-- Name: estado_idestado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE estado_idestado_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.estado_idestado_seq OWNER TO postgres;

--
-- TOC entry 2197 (class 0 OID 0)
-- Dependencies: 1600
-- Name: estado_idestado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE estado_idestado_seq OWNED BY estado.idestado;


--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 1600
-- Name: estado_idestado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estado_idestado_seq', 1, false);


--
-- TOC entry 1601 (class 1259 OID 53037)
-- Dependencies: 6
-- Name: estudiante; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estudiante (
    idestudiante integer NOT NULL,
    idcomuni integer,
    idusuario integer,
    idgrupo integer,
    idpnf integer,
    cedestudiante character varying(10),
    nomestudiante character varying(25),
    apeestudiante character varying(25),
    sexestudiante character varying(1),
    direstudiante character varying(100),
    fnacimientoest date,
    telefestudiante character varying(11),
    mailestudiante character varying(50)
);


ALTER TABLE public.estudiante OWNER TO postgres;

--
-- TOC entry 1602 (class 1259 OID 53040)
-- Dependencies: 6 1601
-- Name: estudiante_idestudiante_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE estudiante_idestudiante_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.estudiante_idestudiante_seq OWNER TO postgres;

--
-- TOC entry 2199 (class 0 OID 0)
-- Dependencies: 1602
-- Name: estudiante_idestudiante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE estudiante_idestudiante_seq OWNED BY estudiante.idestudiante;


--
-- TOC entry 2200 (class 0 OID 0)
-- Dependencies: 1602
-- Name: estudiante_idestudiante_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estudiante_idestudiante_seq', 42, true);


--
-- TOC entry 1603 (class 1259 OID 53042)
-- Dependencies: 6
-- Name: evalentre; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evalentre (
    idevaluacion integer NOT NULL,
    identregable integer NOT NULL
);


ALTER TABLE public.evalentre OWNER TO postgres;

--
-- TOC entry 1604 (class 1259 OID 53045)
-- Dependencies: 6
-- Name: evaluacion_proyecto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evaluacion_proyecto (
    idevaluacion integer NOT NULL,
    idcomision integer,
    idproyecto integer,
    idpersona integer,
    iddocente integer,
    idgrupo integer,
    doc_iddocente integer,
    per_idpersona integer,
    notadescriptiva character varying(2),
    obserevaluacion character varying(255),
    trayectoevaluacion character varying(3)
);


ALTER TABLE public.evaluacion_proyecto OWNER TO postgres;

--
-- TOC entry 1605 (class 1259 OID 53048)
-- Dependencies: 6 1604
-- Name: evaluacion_proyecto_idevaluacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evaluacion_proyecto_idevaluacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.evaluacion_proyecto_idevaluacion_seq OWNER TO postgres;

--
-- TOC entry 2201 (class 0 OID 0)
-- Dependencies: 1605
-- Name: evaluacion_proyecto_idevaluacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evaluacion_proyecto_idevaluacion_seq OWNED BY evaluacion_proyecto.idevaluacion;


--
-- TOC entry 2202 (class 0 OID 0)
-- Dependencies: 1605
-- Name: evaluacion_proyecto_idevaluacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evaluacion_proyecto_idevaluacion_seq', 1, false);


--
-- TOC entry 1606 (class 1259 OID 53050)
-- Dependencies: 6
-- Name: grupo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE grupo (
    idgrupo integer NOT NULL,
    seccion character varying(2)
);


ALTER TABLE public.grupo OWNER TO postgres;

--
-- TOC entry 1607 (class 1259 OID 53053)
-- Dependencies: 1606 6
-- Name: grupo_idgrupo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE grupo_idgrupo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.grupo_idgrupo_seq OWNER TO postgres;

--
-- TOC entry 2203 (class 0 OID 0)
-- Dependencies: 1607
-- Name: grupo_idgrupo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE grupo_idgrupo_seq OWNED BY grupo.idgrupo;


--
-- TOC entry 2204 (class 0 OID 0)
-- Dependencies: 1607
-- Name: grupo_idgrupo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('grupo_idgrupo_seq', 1, false);


--
-- TOC entry 1608 (class 1259 OID 53055)
-- Dependencies: 6
-- Name: jefe_pnf; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE jefe_pnf (
    idjefe integer NOT NULL,
    idusuario integer,
    idpnf integer,
    iddocente integer,
    fechainiciojefe date,
    fechasalidajefe date,
    statusjefe character varying(1)
);


ALTER TABLE public.jefe_pnf OWNER TO postgres;

--
-- TOC entry 1609 (class 1259 OID 53058)
-- Dependencies: 1608 6
-- Name: jefe_pnf_idjefe_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE jefe_pnf_idjefe_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.jefe_pnf_idjefe_seq OWNER TO postgres;

--
-- TOC entry 2205 (class 0 OID 0)
-- Dependencies: 1609
-- Name: jefe_pnf_idjefe_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE jefe_pnf_idjefe_seq OWNED BY jefe_pnf.idjefe;


--
-- TOC entry 2206 (class 0 OID 0)
-- Dependencies: 1609
-- Name: jefe_pnf_idjefe_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('jefe_pnf_idjefe_seq', 1, false);


--
-- TOC entry 1610 (class 1259 OID 53060)
-- Dependencies: 6
-- Name: municipio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE municipio (
    idmunicipio integer NOT NULL,
    idestado integer,
    descripmunicipio character varying(70)
);


ALTER TABLE public.municipio OWNER TO postgres;

--
-- TOC entry 1611 (class 1259 OID 53063)
-- Dependencies: 1610 6
-- Name: municipio_idmunicipio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE municipio_idmunicipio_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.municipio_idmunicipio_seq OWNER TO postgres;

--
-- TOC entry 2207 (class 0 OID 0)
-- Dependencies: 1611
-- Name: municipio_idmunicipio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE municipio_idmunicipio_seq OWNED BY municipio.idmunicipio;


--
-- TOC entry 2208 (class 0 OID 0)
-- Dependencies: 1611
-- Name: municipio_idmunicipio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('municipio_idmunicipio_seq', 1, false);


--
-- TOC entry 1612 (class 1259 OID 53065)
-- Dependencies: 6
-- Name: noticia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE noticia (
    idnoticia integer NOT NULL,
    idusuario integer,
    descripnoticia character varying(1000),
    horapubli time without time zone,
    fechapubli date,
    statusnoticia character varying(2),
    titularnoticia character varying(200)
);


ALTER TABLE public.noticia OWNER TO postgres;

--
-- TOC entry 1613 (class 1259 OID 53071)
-- Dependencies: 6 1612
-- Name: noticia_idnoticia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE noticia_idnoticia_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.noticia_idnoticia_seq OWNER TO postgres;

--
-- TOC entry 2209 (class 0 OID 0)
-- Dependencies: 1613
-- Name: noticia_idnoticia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE noticia_idnoticia_seq OWNED BY noticia.idnoticia;


--
-- TOC entry 2210 (class 0 OID 0)
-- Dependencies: 1613
-- Name: noticia_idnoticia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('noticia_idnoticia_seq', 1, false);


--
-- TOC entry 1614 (class 1259 OID 53073)
-- Dependencies: 6
-- Name: parroquia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE parroquia (
    idparroquia integer NOT NULL,
    idmunicipio integer,
    descripparroquia character varying(50)
);


ALTER TABLE public.parroquia OWNER TO postgres;

--
-- TOC entry 1615 (class 1259 OID 53076)
-- Dependencies: 6 1614
-- Name: parroquia_idparroquia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE parroquia_idparroquia_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.parroquia_idparroquia_seq OWNER TO postgres;

--
-- TOC entry 2211 (class 0 OID 0)
-- Dependencies: 1615
-- Name: parroquia_idparroquia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE parroquia_idparroquia_seq OWNED BY parroquia.idparroquia;


--
-- TOC entry 2212 (class 0 OID 0)
-- Dependencies: 1615
-- Name: parroquia_idparroquia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('parroquia_idparroquia_seq', 1, false);


--
-- TOC entry 1616 (class 1259 OID 53078)
-- Dependencies: 6
-- Name: periodo_academico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE periodo_academico (
    idperiodo integer NOT NULL,
    codperiodo character varying(15),
    fechafinal date,
    fechainicio date
);


ALTER TABLE public.periodo_academico OWNER TO postgres;

--
-- TOC entry 1617 (class 1259 OID 53081)
-- Dependencies: 1616 6
-- Name: periodo_academico_idperiodo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE periodo_academico_idperiodo_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.periodo_academico_idperiodo_seq OWNER TO postgres;

--
-- TOC entry 2213 (class 0 OID 0)
-- Dependencies: 1617
-- Name: periodo_academico_idperiodo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE periodo_academico_idperiodo_seq OWNED BY periodo_academico.idperiodo;


--
-- TOC entry 2214 (class 0 OID 0)
-- Dependencies: 1617
-- Name: periodo_academico_idperiodo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('periodo_academico_idperiodo_seq', 2, true);


--
-- TOC entry 1618 (class 1259 OID 53083)
-- Dependencies: 6
-- Name: personal_sector_comunidad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE personal_sector_comunidad (
    idpersona integer NOT NULL,
    idsectorcomunidad integer,
    idusuario integer,
    cedpersona character varying(11),
    nompersona character varying(25),
    apepersona character varying(25),
    telefpersona character varying(11),
    dirpersona character varying(100),
    emailpersona character varying(50),
    statuspersona character varying(2),
    sexopersona character varying(1)
);


ALTER TABLE public.personal_sector_comunidad OWNER TO postgres;

--
-- TOC entry 1619 (class 1259 OID 53086)
-- Dependencies: 6 1618
-- Name: personal_sector_comunidad_idpersona_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE personal_sector_comunidad_idpersona_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.personal_sector_comunidad_idpersona_seq OWNER TO postgres;

--
-- TOC entry 2215 (class 0 OID 0)
-- Dependencies: 1619
-- Name: personal_sector_comunidad_idpersona_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE personal_sector_comunidad_idpersona_seq OWNED BY personal_sector_comunidad.idpersona;


--
-- TOC entry 2216 (class 0 OID 0)
-- Dependencies: 1619
-- Name: personal_sector_comunidad_idpersona_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('personal_sector_comunidad_idpersona_seq', 1, true);


--
-- TOC entry 1620 (class 1259 OID 53088)
-- Dependencies: 6
-- Name: pnf; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pnf (
    idpnf integer NOT NULL,
    descripcionpnf character varying(50),
    fechainiciopnf date,
    abrevpnf character varying(5)
);


ALTER TABLE public.pnf OWNER TO postgres;

--
-- TOC entry 1621 (class 1259 OID 53091)
-- Dependencies: 6 1620
-- Name: pnf_idpnf_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pnf_idpnf_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.pnf_idpnf_seq OWNER TO postgres;

--
-- TOC entry 2217 (class 0 OID 0)
-- Dependencies: 1621
-- Name: pnf_idpnf_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pnf_idpnf_seq OWNED BY pnf.idpnf;


--
-- TOC entry 2218 (class 0 OID 0)
-- Dependencies: 1621
-- Name: pnf_idpnf_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pnf_idpnf_seq', 1, true);


--
-- TOC entry 1622 (class 1259 OID 53093)
-- Dependencies: 6
-- Name: problema; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE problema (
    idproblema integer NOT NULL,
    idsectorcomunidad integer,
    descripcionproblema character varying(500),
    iddiagnostico integer,
    posiblesolucion character varying(1000),
    seleccionado character varying(1)
);


ALTER TABLE public.problema OWNER TO postgres;

--
-- TOC entry 1623 (class 1259 OID 53099)
-- Dependencies: 6 1622
-- Name: problema_idproblema_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE problema_idproblema_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.problema_idproblema_seq OWNER TO postgres;

--
-- TOC entry 2219 (class 0 OID 0)
-- Dependencies: 1623
-- Name: problema_idproblema_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE problema_idproblema_seq OWNED BY problema.idproblema;


--
-- TOC entry 2220 (class 0 OID 0)
-- Dependencies: 1623
-- Name: problema_idproblema_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('problema_idproblema_seq', 1, false);


--
-- TOC entry 1624 (class 1259 OID 53101)
-- Dependencies: 6
-- Name: proyecto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE proyecto (
    idproyecto integer NOT NULL,
    idgrupo integer,
    idantep integer,
    idjefe integer,
    iddocente integer,
    idpnf integer,
    doc_iddocente integer,
    idpersona integer,
    idproblema integer,
    iddiagnostico integer,
    idperiodo integer,
    codproy character varying(17),
    nomproyecto character varying(255),
    objproyecto character varying(255),
    areaconocimi character varying(100),
    trimestreproy character varying(3),
    trayectoproy character varying(3),
    fechaproy date,
    observproy character varying(255),
    statusproy character varying(20)
);


ALTER TABLE public.proyecto OWNER TO postgres;

--
-- TOC entry 1625 (class 1259 OID 53107)
-- Dependencies: 6 1624
-- Name: proyecto_idproyecto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE proyecto_idproyecto_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.proyecto_idproyecto_seq OWNER TO postgres;

--
-- TOC entry 2221 (class 0 OID 0)
-- Dependencies: 1625
-- Name: proyecto_idproyecto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE proyecto_idproyecto_seq OWNED BY proyecto.idproyecto;


--
-- TOC entry 2222 (class 0 OID 0)
-- Dependencies: 1625
-- Name: proyecto_idproyecto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('proyecto_idproyecto_seq', 10, true);


--
-- TOC entry 1626 (class 1259 OID 53109)
-- Dependencies: 6
-- Name: sector_comunidad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sector_comunidad (
    idsectorcomunidad integer NOT NULL,
    idcomuni integer,
    descripsector character varying(150),
    dirsector character varying(90)
);


ALTER TABLE public.sector_comunidad OWNER TO postgres;

--
-- TOC entry 1627 (class 1259 OID 53112)
-- Dependencies: 6 1626
-- Name: sector_comunidad_idsectorcomunidad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sector_comunidad_idsectorcomunidad_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sector_comunidad_idsectorcomunidad_seq OWNER TO postgres;

--
-- TOC entry 2223 (class 0 OID 0)
-- Dependencies: 1627
-- Name: sector_comunidad_idsectorcomunidad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sector_comunidad_idsectorcomunidad_seq OWNED BY sector_comunidad.idsectorcomunidad;


--
-- TOC entry 2224 (class 0 OID 0)
-- Dependencies: 1627
-- Name: sector_comunidad_idsectorcomunidad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sector_comunidad_idsectorcomunidad_seq', 1, false);


--
-- TOC entry 1628 (class 1259 OID 53114)
-- Dependencies: 6
-- Name: seguridad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE seguridad (
    idseguridad integer NOT NULL,
    idusuario integer,
    accionrealizada character varying(2000),
    fechaaccion timestamp without time zone
);


ALTER TABLE public.seguridad OWNER TO postgres;

--
-- TOC entry 1629 (class 1259 OID 53120)
-- Dependencies: 6 1628
-- Name: seguridad_idseguridad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE seguridad_idseguridad_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.seguridad_idseguridad_seq OWNER TO postgres;

--
-- TOC entry 2225 (class 0 OID 0)
-- Dependencies: 1629
-- Name: seguridad_idseguridad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE seguridad_idseguridad_seq OWNED BY seguridad.idseguridad;


--
-- TOC entry 2226 (class 0 OID 0)
-- Dependencies: 1629
-- Name: seguridad_idseguridad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('seguridad_idseguridad_seq', 260, true);


--
-- TOC entry 1630 (class 1259 OID 53122)
-- Dependencies: 6
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    idusuario integer NOT NULL,
    clave character varying(50),
    login character varying(25),
    fecharegistro date,
    perfilusuario character varying(25)
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 1631 (class 1259 OID 53125)
-- Dependencies: 1630 6
-- Name: usuario_idusuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuario_idusuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.usuario_idusuario_seq OWNER TO postgres;

--
-- TOC entry 2227 (class 0 OID 0)
-- Dependencies: 1631
-- Name: usuario_idusuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_idusuario_seq OWNED BY usuario.idusuario;


--
-- TOC entry 2228 (class 0 OID 0)
-- Dependencies: 1631
-- Name: usuario_idusuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_idusuario_seq', 1, true);


--
-- TOC entry 1911 (class 2604 OID 53127)
-- Dependencies: 1580 1579
-- Name: idantep; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE anteproyecto ALTER COLUMN idantep SET DEFAULT nextval('anteproyecto_idantep_seq'::regclass);


--
-- TOC entry 1912 (class 2604 OID 53128)
-- Dependencies: 1582 1581
-- Name: idcomision; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE comision_tecnica ALTER COLUMN idcomision SET DEFAULT nextval('comision_tecnica_idcomision_seq'::regclass);


--
-- TOC entry 1913 (class 2604 OID 53129)
-- Dependencies: 1584 1583
-- Name: idcomuni; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE comunidad ALTER COLUMN idcomuni SET DEFAULT nextval('comunidad_idcomuni_seq'::regclass);


--
-- TOC entry 1937 (class 2604 OID 53595)
-- Dependencies: 1632 1633 1633
-- Name: idconsejo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE consejo_comunal ALTER COLUMN idconsejo SET DEFAULT nextval('consejo_comunal_idconsejo_seq'::regclass);


--
-- TOC entry 1914 (class 2604 OID 53130)
-- Dependencies: 1586 1585
-- Name: iddenuncia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE denuncia ALTER COLUMN iddenuncia SET DEFAULT nextval('denuncia_iddenuncia_seq'::regclass);


--
-- TOC entry 1915 (class 2604 OID 53131)
-- Dependencies: 1588 1587
-- Name: iddiagnostico; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE diagnostico ALTER COLUMN iddiagnostico SET DEFAULT nextval('diagnostico_iddiagnostico_seq'::regclass);


--
-- TOC entry 1916 (class 2604 OID 53132)
-- Dependencies: 1590 1589
-- Name: iddocente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE docente ALTER COLUMN iddocente SET DEFAULT nextval('docente_iddocente_seq'::regclass);


--
-- TOC entry 1917 (class 2604 OID 53133)
-- Dependencies: 1592 1591
-- Name: identdiag; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE entdiag ALTER COLUMN identdiag SET DEFAULT nextval('entdiag_identdiag_seq'::regclass);


--
-- TOC entry 1918 (class 2604 OID 53134)
-- Dependencies: 1594 1593
-- Name: identproy; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE entproy ALTER COLUMN identproy SET DEFAULT nextval('entproy_identproy_seq'::regclass);


--
-- TOC entry 1919 (class 2604 OID 53135)
-- Dependencies: 1596 1595
-- Name: identreanteproy; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE entreanteproy ALTER COLUMN identreanteproy SET DEFAULT nextval('entreanteproy_identreanteproy_seq'::regclass);


--
-- TOC entry 1920 (class 2604 OID 53136)
-- Dependencies: 1598 1597
-- Name: identregable; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE entregables ALTER COLUMN identregable SET DEFAULT nextval('entregables_identregable_seq'::regclass);


--
-- TOC entry 1921 (class 2604 OID 53137)
-- Dependencies: 1600 1599
-- Name: idestado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE estado ALTER COLUMN idestado SET DEFAULT nextval('estado_idestado_seq'::regclass);


--
-- TOC entry 1922 (class 2604 OID 53138)
-- Dependencies: 1602 1601
-- Name: idestudiante; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE estudiante ALTER COLUMN idestudiante SET DEFAULT nextval('estudiante_idestudiante_seq'::regclass);


--
-- TOC entry 1923 (class 2604 OID 53139)
-- Dependencies: 1605 1604
-- Name: idevaluacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE evaluacion_proyecto ALTER COLUMN idevaluacion SET DEFAULT nextval('evaluacion_proyecto_idevaluacion_seq'::regclass);


--
-- TOC entry 1924 (class 2604 OID 53140)
-- Dependencies: 1607 1606
-- Name: idgrupo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE grupo ALTER COLUMN idgrupo SET DEFAULT nextval('grupo_idgrupo_seq'::regclass);


--
-- TOC entry 1925 (class 2604 OID 53141)
-- Dependencies: 1609 1608
-- Name: idjefe; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE jefe_pnf ALTER COLUMN idjefe SET DEFAULT nextval('jefe_pnf_idjefe_seq'::regclass);


--
-- TOC entry 1926 (class 2604 OID 53142)
-- Dependencies: 1611 1610
-- Name: idmunicipio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE municipio ALTER COLUMN idmunicipio SET DEFAULT nextval('municipio_idmunicipio_seq'::regclass);


--
-- TOC entry 1927 (class 2604 OID 53143)
-- Dependencies: 1613 1612
-- Name: idnoticia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE noticia ALTER COLUMN idnoticia SET DEFAULT nextval('noticia_idnoticia_seq'::regclass);


--
-- TOC entry 1928 (class 2604 OID 53144)
-- Dependencies: 1615 1614
-- Name: idparroquia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE parroquia ALTER COLUMN idparroquia SET DEFAULT nextval('parroquia_idparroquia_seq'::regclass);


--
-- TOC entry 1929 (class 2604 OID 53145)
-- Dependencies: 1617 1616
-- Name: idperiodo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE periodo_academico ALTER COLUMN idperiodo SET DEFAULT nextval('periodo_academico_idperiodo_seq'::regclass);


--
-- TOC entry 1930 (class 2604 OID 53146)
-- Dependencies: 1619 1618
-- Name: idpersona; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE personal_sector_comunidad ALTER COLUMN idpersona SET DEFAULT nextval('personal_sector_comunidad_idpersona_seq'::regclass);


--
-- TOC entry 1931 (class 2604 OID 53147)
-- Dependencies: 1621 1620
-- Name: idpnf; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE pnf ALTER COLUMN idpnf SET DEFAULT nextval('pnf_idpnf_seq'::regclass);


--
-- TOC entry 1932 (class 2604 OID 53148)
-- Dependencies: 1623 1622
-- Name: idproblema; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE problema ALTER COLUMN idproblema SET DEFAULT nextval('problema_idproblema_seq'::regclass);


--
-- TOC entry 1933 (class 2604 OID 53149)
-- Dependencies: 1625 1624
-- Name: idproyecto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE proyecto ALTER COLUMN idproyecto SET DEFAULT nextval('proyecto_idproyecto_seq'::regclass);


--
-- TOC entry 1934 (class 2604 OID 53150)
-- Dependencies: 1627 1626
-- Name: idsectorcomunidad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE sector_comunidad ALTER COLUMN idsectorcomunidad SET DEFAULT nextval('sector_comunidad_idsectorcomunidad_seq'::regclass);


--
-- TOC entry 1935 (class 2604 OID 53151)
-- Dependencies: 1629 1628
-- Name: idseguridad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE seguridad ALTER COLUMN idseguridad SET DEFAULT nextval('seguridad_idseguridad_seq'::regclass);


--
-- TOC entry 1936 (class 2604 OID 53152)
-- Dependencies: 1631 1630
-- Name: idusuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE usuario ALTER COLUMN idusuario SET DEFAULT nextval('usuario_idusuario_seq'::regclass);


--
-- TOC entry 2142 (class 0 OID 52973)
-- Dependencies: 1579
-- Data for Name: anteproyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO anteproyecto (idantep, idjefe, idperiodo, idproblema, idgrupo, iddiagnostico, idpersona, iddocente, doc_iddocente, idpnf, nomantep, objantep, trayectoante, trimestreante, fechaante, observante, statusante, codantep) VALUES (15, 1, 2, 11, 8, 8, 12, 2, 2, 1, 'ACENTÓ LOÑO &quot;COMI&quot;', 'ACENTÓ LOÑO &quot;COMI&quot;', '3', '3', '2013-05-07', 'ACENTÓ LOÑO &quot;COMI&quot;', 'PROCESADO', 'INFANTTIII00009');
INSERT INTO anteproyecto (idantep, idjefe, idperiodo, idproblema, idgrupo, iddiagnostico, idpersona, iddocente, doc_iddocente, idpnf, nomantep, objantep, trayectoante, trimestreante, fechaante, observante, statusante, codantep) VALUES (5, 1, 2, 1, 1, 1, 1, 10, 10, 1, 'RADIO COMUNITARIA CANTARRANA: ESPACIO DE INTEGRACIóN COMUNITARIA CIMENTADO EN LAS TECNOLOGíAS DE INFORMACIóN Y COMUNICACIóN EN LA COMUNIDAD DE CANTARRANA SECTOR SAN JOSé DE CAMINO NUEVO, PARROQUIA SANTA INéS, MUNICIPIO SUCRE, ESTADO SUCRE 2012', 'CREACIÓN D EUNA RADIO COMUNITARIA BAJO AMBIENTE WEB', '4', '3', '2013-05-04', 'SIN OBSERVACIONES...', 'PROCESADO', 'INFANTTIV00005');
INSERT INTO anteproyecto (idantep, idjefe, idperiodo, idproblema, idgrupo, iddiagnostico, idpersona, iddocente, doc_iddocente, idpnf, nomantep, objantep, trayectoante, trimestreante, fechaante, observante, statusante, codantep) VALUES (4, 1, 2, 3, 3, 3, 4, 4, 4, 1, 'ADMINISTRACIóN DE LAS DONACIONES DE MEDICAMENTOS Y EQUIPOS ORTOPéDICOS EN LA COMUNIDAD DE CAIGUIRE SECTOR CAMPO ALEGRE I CUMANA EDO-SUCRE', 'HERRAMIENTA PARA EL CONTROL DE LAS DONACIONES DE MEDICAMENTOS Y EQUIPOS ORTOPéDICOS EN LA COMUNIDAD DE CAIGUIRE SECTOR CAMPO ALEGRE I CUMANA EDO-SUCRE', '4', '3', '2013-05-04', 'SIN OBSERVACIONES...', 'PROCESADO', 'INFANTTIV00001');
INSERT INTO anteproyecto (idantep, idjefe, idperiodo, idproblema, idgrupo, iddiagnostico, idpersona, iddocente, doc_iddocente, idpnf, nomantep, objantep, trayectoante, trimestreante, fechaante, observante, statusante, codantep) VALUES (6, 1, 2, 2, 2, 2, 2, 1, 1, 1, 'SEGURIDAD COMUNITARIA: INCORPORACIóN DE LAS TIC A TRAVéS DE UN SERVICIO DE VIDEOVIGILANCIA COMUNITARIA EN LA COMUNIDAD DE CASCAJAL VIEJO', 'CREACIÓN DE SISTEMA DE VIDEOVIGILANCIA', '4', '3', '2013-05-04', 'SIN OBSERVACIONES...', 'PROCESADO', 'INFANTTIV00006');
INSERT INTO anteproyecto (idantep, idjefe, idperiodo, idproblema, idgrupo, iddiagnostico, idpersona, iddocente, doc_iddocente, idpnf, nomantep, objantep, trayectoante, trimestreante, fechaante, observante, statusante, codantep) VALUES (7, 1, 2, 6, 5, 5, 7, 11, 7, 1, 'APOYO A LOS PLANES DE ESTUDIO E INVESTIGACIóN PARA LA FORMACIóN ACADéMICA DE LA COMUNIDAD ESTUDIANTIL DE CANTARRANA, SECTOR CERRO SABINO', 'DESARROLLAR UN SISTEMA DE INFORMACIóN PARA EL APOYO DE LOS PLANES DE ESTUDIO E INVESTIGACIóN PARA LA FORMACIóN ACADéMICA DE LA COMUNIDAD ESTUDIANTIL DE CANTARRANA, SECTOR CERRO SABINO', '4', '3', '2013-05-05', 'SIN OBSERVACIONES...', 'INICIADO', 'INFANTTIV00007');
INSERT INTO anteproyecto (idantep, idjefe, idperiodo, idproblema, idgrupo, iddiagnostico, idpersona, iddocente, doc_iddocente, idpnf, nomantep, objantep, trayectoante, trimestreante, fechaante, observante, statusante, codantep) VALUES (16, 1, 2, 9, 9, 9, 6, 11, 11, 1, 'TITULO ANTEPROYECTO', 'OBJETIVO GENERAL', '2', '2', '2013-05-10', 'SIN OBSERVACIONES...', 'PROCESADO', 'INFANTTII000016');
INSERT INTO anteproyecto (idantep, idjefe, idperiodo, idproblema, idgrupo, iddiagnostico, idpersona, iddocente, doc_iddocente, idpnf, nomantep, objantep, trayectoante, trimestreante, fechaante, observante, statusante, codantep) VALUES (8, 1, 2, 4, 4, 4, 5, 11, 5, 1, 'PROGRAMA DE ALIMENTACIóN ESCOLAR (PAE): PERMANENCIA Y PROSECUCIóN EN EL SISTEMA BOLIVARIANO DE EDUCACIóN BáSICA COMUNIDAD EDUCATIVA SECTOR "PUERTO ESPAñA" CUMANá. EDO. SUCRE', 'CREACIóN DE UN SISTEMA WEB PARA EL CONTROL DEL PAE', '4', '3', '2013-05-05', 'SIN OBSERVACIONES...', 'INICIADO', 'INFANTTIV00008');


--
-- TOC entry 2143 (class 0 OID 52981)
-- Dependencies: 1581
-- Data for Name: comision_tecnica; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (2, 0, 10, '2013-05-04', '', 'D', 1);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (3, 0, 2, '2013-05-04', '', 'D', 1);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (4, 1, 0, '2013-05-04', '', 'I', 1);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (5, 0, 10, '2013-05-04', '', 'D', 2);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (6, 0, 2, '2013-05-04', '', 'D', 2);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (7, 1, 0, '2013-05-04', '', 'I', 2);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (8, 0, 10, '2013-05-04', '', 'D', 3);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (9, 0, 2, '2013-05-04', '', 'D', 3);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (10, 1, 0, '2013-05-04', '', 'I', 3);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (11, 0, 10, '2013-05-04', '', 'D', 4);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (12, 0, 2, '2013-05-04', '', 'D', 4);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (13, 1, 0, '2013-05-04', '', 'I', 4);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (14, 0, 2, '2013-05-07', '', 'D', 5);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (15, 0, 3, '2013-05-07', '', 'D', 5);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (16, 12, 0, '2013-05-07', '', 'I', 5);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (17, 0, 2, '2013-05-07', '', 'D', 6);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (18, 0, 6, '2013-05-07', '', 'D', 6);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (19, 12, 0, '2013-05-07', '', 'I', 6);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (20, 0, 2, '2013-05-07', '', 'D', 7);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (21, 0, 9, '2013-05-07', '', 'D', 7);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (22, 12, 0, '2013-05-07', '', 'I', 7);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (23, 0, 2, '2013-05-09', '', 'D', 8);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (24, 0, 2, '2013-05-09', '', 'D', 8);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (25, 15, 0, '2013-05-09', '', 'I', 8);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (26, 0, 2, '2013-05-09', '', 'D', 9);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (27, 0, 2, '2013-05-09', '', 'D', 9);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (28, 15, 0, '2013-05-09', '', 'I', 9);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (29, 0, 2, '2013-05-10', '', 'D', 10);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (30, 0, 2, '2013-05-10', '', 'D', 10);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (31, 15, 0, '2013-05-10', '', 'I', 10);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (32, 0, 3, '2013-05-10', '', 'D', 11);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (33, 12, 0, '2013-05-10', '', 'I', 11);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (34, 0, 3, '2013-05-10', '', 'D', 12);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (35, 12, 0, '2013-05-10', '', 'I', 12);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (36, 0, 2, '2013-05-10', '', 'T', 13);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (37, 0, 3, '2013-05-10', '', 'D', 13);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (38, 12, 0, '2013-05-10', '', 'I', 13);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (39, 0, 2, '2013-05-10', '', 'T', 14);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (40, 0, 3, '2013-05-10', '', 'D', 14);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (41, 15, 0, '2013-05-10', '', 'I', 14);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (42, 0, 2, '2013-05-10', '', 'T', 15);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (43, 0, 2, '2013-05-10', '', 'D', 15);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (44, 15, 0, '2013-05-10', '', 'I', 15);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (45, 0, 2, '2013-05-10', '', 'T', 16);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (46, 0, 10, '2013-05-10', '', 'D', 16);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (47, 15, 0, '2013-05-10', '', 'I', 16);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (48, 0, 2, '2013-05-10', '', 'T', 17);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (49, 0, 4, '2013-05-10', '', 'D', 17);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (50, 12, 0, '2013-05-10', '', 'I', 17);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (51, 0, 2, '2013-05-10', '', 'T', 18);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (52, 0, 6, '2013-05-10', '', 'D', 18);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (53, 12, 0, '2013-05-10', '', 'I', 18);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (54, 0, 2, '2013-05-10', '', 'T', 19);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (55, 0, 7, '2013-05-10', '', 'D', 19);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (56, 15, 0, '2013-05-10', '', 'I', 19);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (57, 0, 2, '2013-05-10', '', 'T', 20);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (58, 0, 9, '2013-05-10', '', 'D', 20);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (59, 15, 0, '2013-05-10', '', 'I', 20);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (60, 0, 2, '2013-05-10', '', 'T', 21);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (61, 0, 3, '2013-05-10', '', 'D', 21);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (62, 12, 0, '2013-05-10', '', 'I', 21);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (63, 0, 11, '2013-05-10', '', 'T', 22);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (64, 0, 8, '2013-05-10', '', 'D', 22);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (65, 6, 0, '2013-05-10', '', 'I', 22);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (81, 0, 2, '2013-06-26', '', 'T', 23);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (82, 0, 5, '2013-06-26', '', 'D', 23);
INSERT INTO comision_tecnica (idcomision, idpersona, iddocente, fecha_creacion, obsercomision, identificador, codigocomision) VALUES (83, 12, 0, '2013-06-26', '', 'I', 23);


--
-- TOC entry 2144 (class 0 OID 52986)
-- Dependencies: 1583
-- Data for Name: comunidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (1, 19014002, 'VILLA CAMILA', 'AVENIDA CANCAMURE');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (2, 19014002, 'CANTARRANA', 'CANTARRANA');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (3, 19014002, 'CASCAJAL VIEJO', 'VIA BRASIL');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (4, 19014005, 'CAIGUIRE', 'AVENIDA CARUPANO');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (5, 19014005, 'CAIGUIRE', 'AV. CARUPANO');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (6, 19014002, 'PUERTO ESPAñA', 'CERCA DE PUERTOS DE SUCRE');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (7, 19014002, 'SAN LUIS', 'CERCA DEL CUMANAGOTO');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (8, 19014003, 'CANTARRANA', 'CERCA DE LA UPTOS');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (10, 19014004, 'EL PEñON', 'AV. CUMANA - MARIGUITAR');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (9, 19014004, 'EL PEñON I', 'AVENIDA CUMANA-MARIGUITAR');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (12, 19014002, '&quot;PRUEBA&quot;  CAñóN', '&quot;CAñóN&quot;');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (13, 19014002, '&quot;SAN PEDRO&quot;', 'CUMANAGOTO &quot;SAN LUIS&quot;');
INSERT INTO comunidad (idcomuni, idparroquia, nomcomuni, dircomuni) VALUES (11, 19014002, '&quot;ANDREA&quot; Y COLóN', 'OOOOO');


--
-- TOC entry 2169 (class 0 OID 53592)
-- Dependencies: 1633
-- Data for Name: consejo_comunal; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (1, 1, 'J111111111', '111111', '2013-05-01', 'SAN JOSE CAMINO NUEVO');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (2, 2, 'J222222222', '222222', '2013-05-01', 'CASCAJAL VIEJO');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (3, 3, 'J333333333', '333333', '2013-05-01', 'ASOVEUNCA');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (4, 4, 'J444444444', '444444', '2013-05-01', 'CAMPO ALEGRE I');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (6, 6, 'J666666666', '666666', '2013-05-01', 'SAN LUIS GONZAGA');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (7, 7, 'J777777777', '777777', '2013-05-01', 'CERRO SABINO');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (8, 8, 'J888888888', '888888', '2013-05-01', 'EL PEñON I');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (9, 9, 'J999999999', '999999', '2013-05-01', 'EL PEñON');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (5, 5, 'J555555555', '555555', '2013-05-01', 'PUERTO ESPAñA');
INSERT INTO consejo_comunal (idconsejo, idsectorcomunidad, rifconsejo, sicomconsejo, feculteleccion, nomconsejo) VALUES (10, 10, 'J545545435', '534355', '1900-01-01', '&quot;SAN LUIS II&quot;');


--
-- TOC entry 2145 (class 0 OID 52991)
-- Dependencies: 1585
-- Data for Name: denuncia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (1, 1, 'LOS ESTUDIANTES NO FUERON MAS 1', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-05 21:38:49+00', '21:38:49');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (2, 1, 'LOE INTEGRANTES DE ESTE GRUPO NO PASARON MáS POR LA COMUNIDAD', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-05 21:40:26+00', '21:40:26');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (3, 1, 'LOS ESTUDIANTES DE ESTE PROYECTO NO FUERON MAS A VISITARNOS.', 'PROYECTO', 'INFPROTIV00007', '2013-05-05 21:44:17+00', '21:44:17');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (4, 1, 'LOS ESTUDIANTES FUERON UNA SOLA VEZ Y NO FUERON MAS', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-05 21:45:11+00', '21:45:11');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (5, 1, 'NO FUERON MáS ESTOS ESTUDIANTES, NOS ENGAñARON', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-05 21:48:26+00', '21:48:26');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (6, 1, 'ESTOS NOS VISITARON UNA SOLA VEZ', 'PROYECTO', 'INFPROTIV00007', '2013-05-05 21:49:13+00', '21:49:13');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (7, 3, 'LOS ESTUDIANTES NUNCA ESTUVIERON POR NUESTRA COMUNIDAD', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-05 22:50:50+00', '22:50:50');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (8, 1, 'OOOO', 'DIAGNOSTICO', 'INFDITIV00007', '2013-05-07 22:11:28+00', '22:11:28');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (9, 1, 'LOS ESTUDIANTES NO FUERON MÁS POR EL CONSEJO COMUNAL.', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-10 01:16:54+00', '01:16:54');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (10, 1, 'LOS ESTUDIANTE SNO FUERON POR EL CONSEJO MAS NUNCA', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-10 01:30:52+00', '01:30:52');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (11, 1, 'LOS MUCHACHOS NO FUERON MAS POR LA CASA COMUNAL.', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-10 01:44:21+00', '01:44:21');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (12, 1, 'NO FUERON MáS POR ALLA', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-10 01:45:46+00', '01:45:46');
INSERT INTO denuncia (iddenuncia, idusuario, descripdenuncia, tipodenuncia, codtipo, fechadenuncia, horadenuncia) VALUES (13, 3, 'LOS MUCHACHOS DE LA INVESTIGACION NO FUERON MAS POR LA COMUNIDAD', 'ANTEPROYECTO', 'INFANTTIV00008', '2013-05-10 22:26:10+00', '22:26:10');


--
-- TOC entry 2146 (class 0 OID 52999)
-- Dependencies: 1587
-- Data for Name: diagnostico; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (5, 7, 11, 1, 7, 7, 5, 2, 1, 'CERRO SABINO', '2013-05-05', 'SIN OBSERVACIONES...', '4', '3', 'APOYO A LOS PLANES DE ESTUDIO E INVESTIGACIóN PARA LA FORMACIóN ACADéMICA DE LA COMUNIDAD ESTUDIANTIL DE CANTARRANA, SECTOR CERRO SABINO', 'PROCESADO', 'INFDITIV00005');
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (3, 4, 4, 1, 4, 4, 3, 2, 1, 'CAMPO ALEGRE I', '2013-05-04', 'SIN OBSERVACIONES...', '4', '3', 'ADMINISTRACIóN DE LAS DONACIONES DE MEDICAMENTOS Y EQUIPOS ORTOPéDICOS EN LA COMUNIDAD DE CAIGUIRE SECTOR CAMPO ALEGRE I CUMANA EDO-SUCRE', 'PROCESADO', 'INFDITIV00003');
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (1, 1, 10, 1, 10, 1, 1, 2, 1, 'SAN JOSE CAMINO NUEVO', '2013-05-04', 'SIN OBSERVACIONES...', '4', '3', 'RADIO COMUNITARIA CANTARRANA: ESPACIO DE INTEGRACIóN COMUNITARIA CIMENTADO EN LAS TECNOLOGíAS DE INFORMACIóN Y COMUNICACIóN EN LA COMUNIDAD DE CANTARRANA SECTOR SAN JOSé DE CAMINO NUEVO, PARROQUIA SANTA INéS, MUNICIPIO SUCRE, ESTADO SUCRE 2012', 'PROCESADO', 'INFDITIV00001');
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (2, 2, 1, 1, 1, 2, 2, 2, 1, 'CASCAJAL VIEJO', '2013-05-04', 'SIN OBSERVACIONES...', '4', '3', 'SEGURIDAD COMUNITARIA: INCORPORACIóN DE LAS TIC A TRAVéS DE UN SERVICIO DE VIDEOVIGILANCIA COMUNITARIA EN LA COMUNIDAD DE CASCAJAL VIEJO', 'PROCESADO', 'INFDITIV00002');
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (9, 6, 11, 1, 11, 6, 9, 2, 1, 'SAN LUIS GONZAGA', '2013-05-10', 'SIN OBSERVACIONES...', '4', '3', 'TITULO', 'PROCESADO', 'INFDITIV00009');
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (4, 5, 5, 1, 5, 5, 4, 2, 1, 'PUERTO ESPAñA
', '2013-05-05', 'SIN OBSERVACIONES...', '4', '3', 'PROGRAMA DE ALIMENTACIóN ESCOLAR (PAE): PERMANENCIA Y PROSECUCIóN EN EL SISTEMA BOLIVARIANO DE EDUCACIóN BáSICA COMUNIDAD EDUCATIVA SECTOR "PUERTO ESPAñA" CUMANá. EDO. SUCRE', 'PROCESADO', 'INFDITIV00004');
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (6, 8, 11, 1, 8, 8, 6, 2, 1, 'EL PEñON I', '2013-05-05', 'SIN OBSERVACIONES...', '4', '3', 'SERVICIO TéCNICO INFORMáTICO A LA COMUNIDAD DEL PEñóN', 'INICIADO', 'INFDITIV00006');
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (8, 12, 2, 1, 2, 10, 8, 2, 1, '&quot;SAN LUIS II&quot;', '2013-05-07', 'ACENTó LOñO &quot;COMI&quot;', '3', '3', 'ACENTó LOñO &quot;COMI&quot;', 'PROCESADO', 'INFDITIII00008');
INSERT INTO diagnostico (iddiagnostico, idpersona, iddocente, idpnf, doc_iddocente, idsectorcomunidad, idgrupo, idperiodo, idjefe, nomconsejocomunal, fechadiagnostico, observaciondiagnostico, trayectodiagnostico, trimestrediagnostico, descripdiagnostico, statusdiagnostico, coddiag) VALUES (7, 9, 11, 1, 9, 9, 7, 2, 1, 'EL PEñON', '2013-05-05', 'SIN OBSERVACIONES...', '4', '3', 'TECNOLOGíA Y ADMINISTRACIóN: PRODUCCIóN PESQUERA, CONSEJO DE PESCADORES DEL PODER POPULAR DE EL PEñóN, ESTADO SUCRE', 'INICIADO', 'INFDITIV00007');


--
-- TOC entry 2147 (class 0 OID 53007)
-- Dependencies: 1589
-- Data for Name: docente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (2, 0, 1, 1, 'V12567525', 'ADRIANA CAROLINA', 'CARABALLO GUTIERREZ', 'F', '1900-01-01', '04162384791', 'UNIVERSITARIA', 'INGENIERA EN SISTEMAS', 'URB. SANTA ELENA. CALLE 3. CASA 56', 'ADRI525@YAHOO.ES');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (4, 0, 1, 1, 'V13631637', 'RAFAEL EDUARDO', 'MARIN BRITO', 'M', '1900-01-01', '04164934207', 'UNIVERSITARIA', 'LICENCIADO', 'AVENIDA SANTA ROSA, CASA 12', 'RMARIN@MAIL.IUTCUMANA.RIU.VE');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (5, 0, 1, 1, 'V13222280', 'NAKARY DEL VALLE', 'ORTEGA LEON', 'F', '1900-01-01', '04248146958', 'UNIVERSITARIA', 'LICENCIADA', 'URBANIZACION BERMUDEZ, APTO. 16-B', 'NAKARYORTEGA@HOTMAIL.COM');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (6, 0, 1, 1, 'V11382708', 'EDIYELLY MAIRET', 'GONZALEZ GUARIN', 'F', '1900-01-01', '04148843347', 'UNIVERSITARIA', 'LICENCIADA', 'URBANIZACION GRAN MARISCAL, APTO. P-15', 'EDIYELLY@GMAIL.COM');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (7, 0, 1, 1, 'V12665033', 'ORLANDO LUIS', 'CORONADO HERNANDEZ', 'M', '1900-01-01', '04168936743', 'UNIVERSITARIO', 'INGENIERO', 'URB. CAMPO CLARO, CASA 34. CALLE F', 'OLCH18@GMAIL.COM');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (8, 0, 1, 1, 'V13053555', 'LUISANA', 'PAREJO', 'F', '1900-01-01', '04121897965', 'UNIVERSITARIA', 'LICENCIADA', 'CALLE ARISMENDI. CASA 34', 'LUISANAPR@GMAIL.COM');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (9, 0, 1, 1, 'V11378327', 'LICARMEN MERYS', 'MARTINEZ MARTI', 'F', '1900-01-01', '04168939824', 'UNIVERSITARI', 'INGENIERA', 'URB. LUZ DEL MUNDO. CALLE 100. CASA 154', 'LICARMENMARTINEZIUT@GMAIL.COM');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (10, 0, 1, 1, 'V11826847', 'YALGIS DEL VALLE', 'RODRIGUEZ RENGEL', 'F', '1900-01-01', '04268814305', 'UNIVERSITARIA', 'INGENIERA', 'SIN DIRECCION', 'SINCORREO276@GMAIL.COM');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (11, 0, 1, 1, 'V13731079', 'LUIS ANIBAL', 'BRITO SALAZAR', 'M', '1900-01-01', '04166055099', 'UNIVERSITARIO', 'LICENCIADO', 'SIN DIRECCION', 'LABS154@HOTMAIL.COM');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (12, 0, 1, 1, 'V45555555', 'OOOOOOOOOOOO', 'OOOOOOOOOOOO', 'M', '1900-01-01', '', 'OOOOOOOOOOOOOOOOO', 'OOOOOOOOOOOOOOOOO', 'OOOOOOOOOOOOOOOOO', 'OOOOOO@OOOOO.COM');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (1, 1, 1, 1, 'V13942458', 'JOSE EDUARDO', 'RODRIGUEZ GONZALEZ', 'M', '1987-05-12', '04128789615', 'UNIVERSITARIO', 'INGENIERO EN SISTEMAS', 'URB. VILLA CAMILA. CALLE 18. CASA F5', 'ING_JERG2004@YAHOO.ES');
INSERT INTO docente (iddocente, idusuario, idpnf, idcomuni, ceddocente, nomdocente, apedocente, sexdocente, fnacimiento, telefdocente, gradoinstruccion, profesion, direccdocente, maildocente) VALUES (3, 0, 1, 1, 'V10460671', 'DORINA DEL VALLE', 'LOPEZ DE REYES', 'F', '1900-01-01', '04166930205', 'UNIVERSITARIA', 'INGENIERA', 'URB. ALTAGRACIA. CALLE U. CASA 3', 'DORINALOPEZ@HOTMAIL.COM');


--
-- TOC entry 2148 (class 0 OID 53012)
-- Dependencies: 1591
-- Data for Name: entdiag; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2149 (class 0 OID 53017)
-- Dependencies: 1593
-- Data for Name: entproy; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2150 (class 0 OID 53022)
-- Dependencies: 1595
-- Data for Name: entreanteproy; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2151 (class 0 OID 53027)
-- Dependencies: 1597
-- Data for Name: entregables; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2152 (class 0 OID 53032)
-- Dependencies: 1599
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO estado (idestado, descripestado) VALUES (3, 'Anzoátegui');
INSERT INTO estado (idestado, descripestado) VALUES (7, 'Bolívar');
INSERT INTO estado (idestado, descripestado) VALUES (11, 'Falcón');
INSERT INTO estado (idestado, descripestado) VALUES (12, 'Guárico');
INSERT INTO estado (idestado, descripestado) VALUES (14, 'Mérida');
INSERT INTO estado (idestado, descripestado) VALUES (20, 'Táchira');
INSERT INTO estado (idestado, descripestado) VALUES (9, 'Cojedes');
INSERT INTO estado (idestado, descripestado) VALUES (8, 'Carabobo');
INSERT INTO estado (idestado, descripestado) VALUES (4, 'Apure');
INSERT INTO estado (idestado, descripestado) VALUES (2, 'Amazonas');
INSERT INTO estado (idestado, descripestado) VALUES (5, 'Aragua');
INSERT INTO estado (idestado, descripestado) VALUES (6, 'Barinas');
INSERT INTO estado (idestado, descripestado) VALUES (10, 'Delta Amacuro');
INSERT INTO estado (idestado, descripestado) VALUES (13, 'Lara');
INSERT INTO estado (idestado, descripestado) VALUES (15, 'Miranda');
INSERT INTO estado (idestado, descripestado) VALUES (16, 'Monagas');
INSERT INTO estado (idestado, descripestado) VALUES (17, 'Nueva Esparta');
INSERT INTO estado (idestado, descripestado) VALUES (18, 'Portuguesa');
INSERT INTO estado (idestado, descripestado) VALUES (19, 'Sucre');
INSERT INTO estado (idestado, descripestado) VALUES (21, 'Trujillo');
INSERT INTO estado (idestado, descripestado) VALUES (22, 'Yaracuy');
INSERT INTO estado (idestado, descripestado) VALUES (23, 'Zulia');
INSERT INTO estado (idestado, descripestado) VALUES (24, 'Vargas');
INSERT INTO estado (idestado, descripestado) VALUES (1, 'Distrito Capital');


--
-- TOC entry 2153 (class 0 OID 53037)
-- Dependencies: 1601
-- Data for Name: estudiante; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (11, 1, 0, 0, 1, 'V16995504', 'FRANCES', 'ESPINOZA', 'F', 'URBANIZACION ROMULO GALLEGOS, CALLE 19, CASA 159', '1984-05-17', '04140899559', 'FRANCES.ESPINOZA@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (12, 1, 0, 0, 1, 'V15740964', 'OSWALDO', 'FRANCO', 'M', 'SIN DIRECCION', '1982-05-05', '04168932790', 'FRANCO.OSWALDO@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (20, 1, 0, 6, 1, 'V16818597', 'MIGUEL', 'VELASQUEZ', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO14@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (21, 1, 0, 6, 1, 'V16818648', 'CARLOS', 'VALDIVIE', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO14@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (22, 1, 0, 6, 1, 'V16313275', 'DAVID', 'VILLANUEVA', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO15@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (36, 1, 0, 0, 1, 'V14661396', 'MIGUEL', 'APARICIO', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO39@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (2, 1, 0, 1, 1, 'V17445805', 'DEYSI', 'GONZALEZ', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (3, 1, 0, 1, 1, 'V17539586', 'EDINSON', 'GONZALEZ', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO2@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (4, 1, 0, 1, 1, 'V16484128', 'EDUARDO', 'GONZALEZ', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO3@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (5, 1, 0, 1, 1, 'V17445009', 'LUISMER', 'MARIN', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO4@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (6, 1, 0, 1, 1, 'V16338682', 'OSMAN', 'PINEDA', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO5@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (7, 1, 0, 1, 1, 'V16817781', 'VICTOR', 'UZCATEGUI', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO6@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (27, 1, 0, 2, 1, 'V16172520', 'CANDY', 'VILLARROEL', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO30@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (28, 1, 0, 2, 1, 'V15110637', 'CARLOS', 'ARENAS', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO31@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (29, 1, 0, 2, 1, 'V15934802', 'DANNY', 'LANZA', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO32@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (30, 1, 0, 2, 1, 'V16702891', 'FRANK', 'PEREDA', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO34@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (31, 1, 0, 2, 1, 'V14124565', 'KATIUSKA', 'LISCANO', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO35@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (42, 1, 0, 8, 1, 'V44353453', 'RGREG', 'RGERGR', 'F', 'REGERRRGREGG &quot;PP&quot;', '1900-01-01', '', 'EGRREG@TRJT.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (40, 1, 0, 9, 1, 'V17909215', 'EDDY', 'RODRIGUEZ', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO45@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (37, 1, 0, 0, 1, 'V18211259', 'RICARDO JOSE', 'LOPEZ', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO45@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (8, 1, 0, 4, 1, 'V16314821', 'CHRISTIAN', 'HERNANDEZ', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO6@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (10, 1, 0, 4, 1, 'V5086719', 'RODOLFO', 'ORTIZ', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO7@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (9, 1, 0, 4, 1, 'V15249486', 'XIOMARA', 'MARCHAN', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO6@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (17, 1, 0, 5, 1, 'V17212861', 'FRANMELYS', 'DIONICIO', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO11@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (19, 1, 0, 5, 1, 'V15740816', 'LUIS', 'DURAN', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO13@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (15, 1, 0, 5, 1, 'V18418185', 'ROSANGELA', 'MILLAN', 'F', 'SIN DIRECCIOON', '1900-01-01', '', 'SINCORREO90@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (16, 1, 0, 5, 1, 'V18212940', 'ROSELYS', 'MUDARRA', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO10@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (18, 1, 0, 5, 1, 'V15934877', 'SILVIA', 'ASTUDILLO', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO12@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (38, 1, 0, 9, 1, 'V16818049', 'ELVI', 'MILIAN', 'F', 'SIN DIRECCION', '1900-01-01', '04163206695', 'SINCORREO76@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (24, 1, 0, 7, 1, 'V15936060', 'BELKIS', 'MORENO', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO16@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (25, 1, 0, 7, 1, 'V16817559', 'MARIEVA', 'ACUñA', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO17@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (26, 1, 0, 7, 1, 'V15741078', 'MIRTHA', 'AMAYA', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO17@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (23, 1, 0, 7, 1, 'V15289129', 'YNDIRA', 'MARCANO', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO15@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (39, 1, 0, 0, 1, 'V17911619', 'LEAFAR', 'ARAUJO', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO456@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (32, 1, 0, 3, 1, 'V14008427', 'ELIZABETH', 'DIAZ', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO36@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (33, 1, 0, 3, 1, 'V15935505', 'ERNESTO', 'RIVAS', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO37@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (34, 1, 0, 3, 1, 'V14815393', 'KARELYS', 'ARREDONDO', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO37@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (35, 1, 0, 3, 1, 'V16486762', 'JULIO', 'FIGUEROA', 'M', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO39@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (14, 1, 0, 0, 1, 'V16701874', 'ROSA', 'ACEVEDO', 'F', 'CANTARRANA', '1900-01-01', '', 'SINCORREO9@GMAIL.COM');
INSERT INTO estudiante (idestudiante, idcomuni, idusuario, idgrupo, idpnf, cedestudiante, nomestudiante, apeestudiante, sexestudiante, direstudiante, fnacimientoest, telefestudiante, mailestudiante) VALUES (13, 1, 0, 0, 1, 'V17213040', 'VANESSA', 'ORTIZ', 'F', 'SIN DIRECCION', '1900-01-01', '', 'SINCORREO8@GMAIL.COM');


--
-- TOC entry 2154 (class 0 OID 53042)
-- Dependencies: 1603
-- Data for Name: evalentre; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2155 (class 0 OID 53045)
-- Dependencies: 1604
-- Data for Name: evaluacion_proyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO evaluacion_proyecto (idevaluacion, idcomision, idproyecto, idpersona, iddocente, idgrupo, doc_iddocente, per_idpersona, notadescriptiva, obserevaluacion, trayectoevaluacion) VALUES (1, 4, 6, 1, 10, 1, 10, 1, 'A', 'Sin comentarios...', '4');
INSERT INTO evaluacion_proyecto (idevaluacion, idcomision, idproyecto, idpersona, iddocente, idgrupo, doc_iddocente, per_idpersona, notadescriptiva, obserevaluacion, trayectoevaluacion) VALUES (2, 22, 10, 6, 11, 9, 11, 6, 'A', 'SIN OBSERVACIONES...', '4');
INSERT INTO evaluacion_proyecto (idevaluacion, idcomision, idproyecto, idpersona, iddocente, idgrupo, doc_iddocente, per_idpersona, notadescriptiva, obserevaluacion, trayectoevaluacion) VALUES (3, 23, 9, 12, 2, 8, 2, 12, 'A', 'SIN OBSERVACIONES...', '3');


--
-- TOC entry 2156 (class 0 OID 53050)
-- Dependencies: 1606
-- Data for Name: grupo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO grupo (idgrupo, seccion) VALUES (0, '0');
INSERT INTO grupo (idgrupo, seccion) VALUES (1, '01');
INSERT INTO grupo (idgrupo, seccion) VALUES (2, '01');
INSERT INTO grupo (idgrupo, seccion) VALUES (3, '02');
INSERT INTO grupo (idgrupo, seccion) VALUES (4, '02');
INSERT INTO grupo (idgrupo, seccion) VALUES (5, '02');
INSERT INTO grupo (idgrupo, seccion) VALUES (6, '02');
INSERT INTO grupo (idgrupo, seccion) VALUES (7, '02');
INSERT INTO grupo (idgrupo, seccion) VALUES (8, '01');
INSERT INTO grupo (idgrupo, seccion) VALUES (9, '02');


--
-- TOC entry 2157 (class 0 OID 53055)
-- Dependencies: 1608
-- Data for Name: jefe_pnf; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO jefe_pnf (idjefe, idusuario, idpnf, iddocente, fechainiciojefe, fechasalidajefe, statusjefe) VALUES (1, 1, 1, 1, '2013-05-01', '2013-06-28', '0');
INSERT INTO jefe_pnf (idjefe, idusuario, idpnf, iddocente, fechainiciojefe, fechasalidajefe, statusjefe) VALUES (2, 0, 1, 12, '2013-06-28', '2013-06-29', '0');
INSERT INTO jefe_pnf (idjefe, idusuario, idpnf, iddocente, fechainiciojefe, fechasalidajefe, statusjefe) VALUES (3, 0, 1, 1, '2013-06-29', '2013-06-29', '0');
INSERT INTO jefe_pnf (idjefe, idusuario, idpnf, iddocente, fechainiciojefe, fechasalidajefe, statusjefe) VALUES (4, 0, 1, 3, '2013-06-29', '1900-01-01', '1');


--
-- TOC entry 2158 (class 0 OID 53060)
-- Dependencies: 1610
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (1001, 1, ' Autónomo Libertador');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (2001, 2, ' Autónomo Alto Orinoco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (2002, 2, ' Autónomo Atabapo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (2003, 2, ' Autónomo Atures');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (2004, 2, ' Autónomo Autana');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (2005, 2, ' Autónomo Maroa');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (2006, 2, ' Autónomo Manapiare');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (2007, 2, ' Autónomo Río Negro');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3001, 3, ' Anaco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3002, 3, ' Aragua');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3003, 3, ' Fernando de Peñalver');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3004, 3, ' Francisco del Carmen Carvajal');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3005, 3, ' Francisco de Miranda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3006, 3, ' Guanta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3007, 3, ' Independencia');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3008, 3, ' Juan Antonio Sotillo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3009, 3, ' Juan Manuel Cajigal');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3010, 3, ' José Gregorio Monagas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3011, 3, ' Libertad');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3012, 3, ' Manuel Ezequiel Bruzual');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3013, 3, ' Pedro María Freites');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3014, 3, ' P&iacute;ritu');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3015, 3, ' San Jos&eacute; de Guanipa');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3016, 3, ' San Juan de Capistrano');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3017, 3, ' Santa Ana');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3018, 3, ' Sim&oacute;n Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3019, 3, ' Sim&oacute;n Rodr&iacute;guez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3020, 3, ' Sir Arthur Mc Gregor');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (3021, 3, ' Diego Bautista Urbaneja');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (4001, 4, ' Achaguas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (4002, 4, ' Biruaca');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (4003, 4, ' Mu&ntilde;oz');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (4004, 4, ' P&aacute;ez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (4005, 4, ' Pedro Camejo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (4006, 4, ' R&oacute;mulo Gallegos');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (4007, 4, ' San Fernando');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5001, 5, ' Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5002, 5, ' Camatagua');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5003, 5, ' Girardot');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5004, 5, ' Jos&eacute; Angel Lamas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5005, 5, ' Jos&eacute; F&eacute;lix Ribas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5006, 5, ' Jos&eacute; Rafael Revenga');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5007, 5, ' Libertador');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5008, 5, ' Mario Brice&ntilde;o Iragorry');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5009, 5, ' San Casimiro');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5010, 5, ' San Sebasti&aacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5011, 5, ' Santiago Mari&ntilde;o');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5012, 5, ' Santos Michelena');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5013, 5, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5014, 5, ' Tovar');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5015, 5, ' Urdaneta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5016, 5, ' Zamora');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5017, 5, ' Francisco Linares Alc&aacute;ntara');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (5018, 5, ' Ocumare de La Costa de Oro');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6001, 6, ' Alberto Arvelo Torrealba');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6002, 6, ' Antonio Jos&eacute; de Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6003, 6, ' Arismendi');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6004, 6, ' Barinas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6005, 6, ' Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6006, 6, ' Cruz Paredes');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6007, 6, ' Ezequiel Zamora');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6008, 6, ' Obispos');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6009, 6, ' Pedraza');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6010, 6, ' Rojas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6011, 6, ' Sosa');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (6012, 6, ' Andr&eacute;s Eloy Blanco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7001, 7, ' Caron&iacute;');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7002, 7, ' Cede&ntilde;o');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7003, 7, ' El Callao');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7004, 7, ' Gran Sabana');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7005, 7, ' Heres');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7006, 7, ' Piar');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7007, 7, ' Ra&uacute;l Leoni');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7008, 7, ' Roscio');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7009, 7, ' Sifontes');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7010, 7, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (7011, 7, ' Padre Pedro Chien');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8001, 8, ' Bejuma');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8002, 8, ' Carlos Arvelo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8003, 8, ' Diego Ibarra');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8004, 8, ' Guacara');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8005, 8, ' Juan Jos&eacute; Mora');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8006, 8, ' Libertador');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8007, 8, ' Los Guayos');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8008, 8, ' Miranda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8009, 8, ' Montalb&aacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8010, 8, ' Naguanagua');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8011, 8, ' Puerto Cabello');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8012, 8, ' San Diego');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8013, 8, ' San Joaqu&iacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8014, 8, ' Valencia');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (8015, 8, ' Los Naranjos');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9001, 9, ' Anzo&aacute;tegui');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9002, 9, ' Falc&oacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9003, 9, ' Girardot');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9004, 9, ' Lima Blanco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9005, 9, ' Pao de San Juan Bautista');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9006, 9, ' Ricaurte');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9007, 9, ' R&oacute;mulo Gallegos');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9008, 9, ' San Carlos');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (9009, 9, ' Tinaco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (10001, 10, ' Antonio D&iacute;az');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (10002, 10, ' Casacoima');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (10003, 10, ' Pedernales');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (10004, 10, ' Tucupita');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11001, 11, ' Acosta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11002, 11, ' Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11003, 11, ' Buchivacoa');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11004, 11, ' Cacique Manaure');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11005, 11, ' Carirubana');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11006, 11, ' Colina');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11007, 11, ' Dabajuro');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11008, 11, ' Democracia');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11009, 11, ' Falc&oacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11010, 11, ' Federaci&oacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11011, 11, ' Jacura');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11012, 11, ' Los Taques');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11013, 11, ' Mauroa');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11014, 11, ' Miranda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11015, 11, ' Monse&ntilde;or Iturriza');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11016, 11, ' Palmasola');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11017, 11, ' Petit');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11018, 11, ' P&iacute;ritu');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11019, 11, ' San Francisco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11020, 11, ' Silva');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11021, 11, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11022, 11, ' Toc&oacute;pero');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11023, 11, ' Uni&oacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11024, 11, ' Urumaco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (11025, 11, ' Zamora');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12001, 12, ' Camagu&aacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12002, 12, ' Chaguaramas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12003, 12, ' El Socorro');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12004, 12, ' San Ger&oacute;nimo de Guayabal');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12005, 12, ' Leonardo Infante');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12006, 12, ' Las Mercedes');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12007, 12, ' Juli&aacute;n Mellado');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12008, 12, ' Francisco de Miranda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12009, 12, ' Jos&eacute; Tadeo Monagas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12010, 12, ' Ortiz');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12011, 12, ' Jos&eacute; F&eacute;lix Ribas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12012, 12, ' Juan Germ&aacute;n Roscio');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12013, 12, ' San Jos&eacute; de Guaribe');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12014, 12, ' Santa Mar&iacute;a de Ipire');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (12015, 12, ' Pedro Zaraza');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13001, 13, ' Andr&eacute;s Eloy Blanco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13002, 13, ' Crespo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13003, 13, ' Iribarren');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13004, 13, ' Jim&eacute;nez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13005, 13, ' Mor&aacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13006, 13, ' Palavecino');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13007, 13, ' Sim&oacute;n Planas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13008, 13, ' Torres');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (13009, 13, ' Urdaneta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14001, 14, ' Alberto Adriani');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14002, 14, ' Andr&eacute;s Bello');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14003, 14, ' Antonio Pinto Salinas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14004, 14, ' Aricagua');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14005, 14, ' Arzobispo Chac&oacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14006, 14, ' Campo El&iacute;as');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14007, 14, ' Caracciolo Parra Y Olmedo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14008, 14, ' Cardenal Quintero');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14009, 14, ' Guaraque');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14010, 14, ' Julio C&eacute;sar Salas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14011, 14, ' Justo Brice&ntilde;o');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14012, 14, ' Libertador');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14013, 14, ' Miranda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14014, 14, ' Obispo Ramos de Lora');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14015, 14, ' Padre Noguera');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14016, 14, ' Pueblo Llano');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14017, 14, ' Rangel');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14018, 14, ' Rivas D&aacute;vila');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14019, 14, ' Santos Marquina');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14020, 14, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14021, 14, ' Tovar');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14022, 14, ' Tulio Febres Cordero');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (14023, 14, ' Zea');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15001, 15, ' Acevedo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15002, 15, ' Andr&eacute;s Bello');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15003, 15, ' Baruta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15004, 15, ' Bri&oacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15005, 15, ' Buroz');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15006, 15, ' Carrizal');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15007, 15, ' Chacao');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15008, 15, ' Crist&oacute;bal Rojas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15009, 15, ' El Hatillo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15010, 15, ' Guaicaipuro');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15011, 15, ' Independencia');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15012, 15, ' Tomas Lander');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15013, 15, ' Los Salias');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15014, 15, ' P&aacute;ez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15015, 15, ' Paz Castillo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15016, 15, ' Pedro Gual');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15017, 15, ' Plaza');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15018, 15, ' Sim&oacute;n Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15019, 15, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15020, 15, ' Urdaneta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (15021, 15, ' Zamora');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16001, 16, ' Acosta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16002, 16, ' Aguasay');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16003, 16, ' Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16004, 16, ' Caripe');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16005, 16, ' Cede&ntilde;o');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16006, 16, ' Ezequiel Zamora');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16007, 16, ' Libertador');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16008, 16, ' Matur&iacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16009, 16, ' Piar');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16010, 16, ' Punceres');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16011, 16, ' Santa B&aacute;rbara');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16012, 16, ' Sotillo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (16013, 16, ' Uracoa');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17001, 17, ' Antol&iacute;n Del Campo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17002, 17, ' Arismendi');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17003, 17, ' D&iacute;az');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17004, 17, ' Garc&iacute;a');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17005, 17, ' G&oacute;mez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17006, 17, ' Maneiro');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17007, 17, ' Marcano');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17008, 17, ' Mari&ntilde;o');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17009, 17, ' Pen&iacute;nsula de Macanao');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17010, 17, ' Tubores');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (17011, 17, ' Villalba');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18001, 18, ' Agua Blanca');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18002, 18, ' Araure');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18003, 18, ' Esteller');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18004, 18, ' Guanare');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18005, 18, ' Guanarito');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18006, 18, ' Monse&ntilde;or Jos&eacute; Vicente de Unda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18007, 18, ' Ospino');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18008, 18, ' P&aacute;ez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18009, 18, ' Papel&oacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18010, 18, ' San Genaro de Boconoito');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18011, 18, ' San Rafael de Onoto');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18012, 18, ' Santa Rosal&iacute;a');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18013, 18, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (18014, 18, ' Tur&eacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19001, 19, ' Andr&eacute;s Eloy Blanco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19002, 19, ' Andr&eacute;s Mata');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19003, 19, ' Arismendi');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19004, 19, ' Ben&iacute;tez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19005, 19, ' Berm&uacute;dez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19006, 19, ' Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19007, 19, ' Cajigal');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19008, 19, ' Cruz Salmer&oacute;n Acosta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19009, 19, ' Libertador');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19010, 19, ' Mari&ntilde;o');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19011, 19, ' Mej&iacute;a');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19012, 19, ' Montes');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19013, 19, ' Ribero');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19014, 19, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (19015, 19, ' Valdez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20001, 20, ' Andr&eacute;s Bello');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20002, 20, ' Antonio R&oacute;mulo Costa');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20003, 20, ' Ayacucho');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20004, 20, ' Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20005, 20, ' C&aacute;rdenas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20006, 20, ' C&oacute;rdoba');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20007, 20, ' Fern&aacute;ndez Feo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20008, 20, ' Francisco de Miranda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20009, 20, ' Garc&iacute;a de Hevia');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20010, 20, ' Gu&aacute;simos');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20011, 20, ' Independencia');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20012, 20, ' J&aacute;uregui');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20013, 20, ' Jos&eacute; Mar&iacute;a Vargas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20014, 20, ' Jun&iacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20015, 20, ' Libertad');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20016, 20, ' Libertador');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20017, 20, ' Lobatera');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20018, 20, ' Michelena');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20019, 20, ' Panamericano');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20020, 20, ' Pedro Mar&iacute;a Ure&ntilde;a');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20021, 20, ' Rafael Urdaneta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20022, 20, ' Samuel Dar&iacute;o Maldonado');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20023, 20, ' San Crist&oacute;bal');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20024, 20, ' Seboruco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20025, 20, ' Sim&oacute;n Rodr&iacute;guez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20026, 20, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20027, 20, ' Torbes');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20028, 20, ' Uribante');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (20029, 20, ' San Judas Tadeo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21001, 21, ' Andr&eacute;s Bello');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21002, 21, ' Bocon&oacute;');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21003, 21, ' Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21004, 21, ' Candelaria');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21005, 21, ' Carache');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21006, 21, ' Escuque');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21007, 21, ' Jos&eacute; Felipe M&aacute;rquez Ca&ntilde;izales');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21008, 21, ' Juan Vicente Campo El&iacute;as');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21009, 21, ' La Ceiba');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21010, 21, ' Miranda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21011, 21, ' Monte Carmelo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21012, 21, ' Motat&aacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21013, 21, ' Pamp&aacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21014, 21, ' Pampanito');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21015, 21, ' Rafael Rangel');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21016, 21, ' San Rafael de Carvajal');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21017, 21, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21018, 21, ' Trujillo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21019, 21, ' Urdaneta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (21020, 21, ' Valera');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22001, 22, ' Ar&iacute;stides Bastidas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22002, 22, ' Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22003, 22, ' Bruzual');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22004, 22, ' Cocorote');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22005, 22, ' Independencia');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22006, 22, ' Jos&eacute; Antonio P&aacute;ez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22007, 22, ' La Trinidad');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22008, 22, ' Manuel Monge');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22009, 22, ' Nirgua');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22010, 22, ' Pe&ntilde;a');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22011, 22, ' San Felipe');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22012, 22, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22013, 22, ' Urachiche');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (22014, 22, ' Veroes');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23001, 23, ' Almirante Padilla');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23002, 23, ' Baralt');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23003, 23, ' Cabimas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23004, 23, ' Catatumbo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23005, 23, ' Col&oacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23006, 23, ' Francisco Javier Pulgar');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23007, 23, ' Jes&uacute;s Enrique Lossada');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23008, 23, ' Jes&uacute;s Mar&iacute;a Sempr&uacute;n');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23009, 23, ' La Ca&ntilde;ada de Urdaneta');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23010, 23, ' Lagunillas');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23011, 23, ' Machiques de Perij&aacute;');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23012, 23, ' Mara');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23013, 23, ' Maracaibo');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23014, 23, ' Miranda');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23015, 23, ' P&aacute;ez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23016, 23, ' Rosario de Perij&aacute;');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23017, 23, ' San Francisco');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23018, 23, ' Santa Rita');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23019, 23, ' Sim&oacute;n Bol&iacute;var');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23020, 23, ' Sucre');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (23021, 23, ' Valmore Rodr&iacute;guez');
INSERT INTO municipio (idmunicipio, idestado, descripmunicipio) VALUES (24001, 24, ' Vargas');


--
-- TOC entry 2159 (class 0 OID 53065)
-- Dependencies: 1612
-- Data for Name: noticia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO noticia (idnoticia, idusuario, descripnoticia, horapubli, fechapubli, statusnoticia, titularnoticia) VALUES (1, 1, 'EL DíA LUNES 06 DE MAYO DE 2013 INICIAREMOS LA JORNADA DE CARNETIZACIóN, EN LA
SALA ALMA MATER II, EN EL HORARIO COMPRENDIDO DE:
8:00AM A 12:00M - 1:30PM A 3:30PM
RESPONSABLES: OFICINA DE INFORMáTICA Y TELEMáTICA', '02:29:24', '2013-05-10', '1', 'JORNADA DE CARNETIZACIóN CUMANá - MAYO 2013');
INSERT INTO noticia (idnoticia, idusuario, descripnoticia, horapubli, fechapubli, statusnoticia, titularnoticia) VALUES (2, 1, 'EL PASADO MIéRCOLES 06 DE MAYO DE 2013, SE REALIZó EL HOMENAJE AL LIBERTADOR CON LA BANDA MARCIAL DEL CUARTEL, CON MOTIVO DEL 1ER ANIVERSARIO DE LA UPTOSCR.

EL ACTO CONSTó DE UNA OFRENDA FLORAL, DISCURSO POR PARTE DEL RECTOR DE NUESTRA INSTITUCIóN Y EL MINUTO DE SILENCIO CON UN SóLO DE TROMPETA (2 MESES DE LA DESAPARICIóN FíSICA DEL PRESIDENTE HUGO CHáVEZ FRíAS).

TODOS LOS PRESENTES EN LA PLAZA BOLIVAR DE CUMANá SE DELEITARON CON DOS PIEZAS DE ANTAñO EJECUTADAS POR LA BANDA MARCIAL INVITADA.', '02:31:32', '2013-05-10', '1', 'OFRENDA FLORAL');
INSERT INTO noticia (idnoticia, idusuario, descripnoticia, horapubli, fechapubli, statusnoticia, titularnoticia) VALUES (3, 1, 'EL FORO SOBRE LA NUEVA LEY ORGáNICA DEL TRABAJO, LOS TRABAJADORES Y TRABAJADORAS SE REALIZó CON éXITO.
LA AUDIENCIA ESTUVO CONFORMADA, EN SU MAYORíA, POR MIEMBROS DE LA COMUNIDAD UNIVERSITARIA QUE INTEGRAN EL EQUIPO ADMINISTRATIVO.

EL CONFERENCISTA, ABOGADO JESúS ARISMENDI, SE ESMERó EN QUE TODOS LOS PRESENTES COMPRENDIRAN LAS RESOLUCIONES, ORIGEN Y FóRMULAS; ADEMáS DE REALIZAR COMPARACIONES ENTRE LA LEY DEL TRABAJO Y LA LEY ORGáNICA DEL TRABAJO, LOS TRABAJADORES Y TRABAJADORAS.

LA AUDIENCIA ESTUVO MUY PARTICIPATIVA Y SOLICITARON UN CURSO CON ESTE DESTACADO ABOGADO, QUIEN TAMBIéN REALIZA TRABAJO DOCENTE A NIVEL MEDIO Y UNIVERSITARIO.', '02:31:50', '2013-05-10', '1', 'FORO SOBRE LA NUEVA LOTTT ');


--
-- TOC entry 2160 (class 0 OID 53073)
-- Dependencies: 1614
-- Data for Name: parroquia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001001, 1001, ' Caracas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001002, 1001, ' Altagracia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001003, 1001, ' Ant&iacute;mano');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001004, 1001, ' Candelaria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001005, 1001, ' Caricuao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001006, 1001, ' Catedral');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001008, 1001, ' El Junquito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001009, 1001, ' El Para&iacute;so');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001010, 1001, ' El Recreo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001011, 1001, ' El Valle');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001012, 1001, ' La Pastora');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001013, 1001, ' La Vega');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001014, 1001, ' Macarao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001015, 1001, ' San Agust&iacute;n');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001016, 1001, ' San Bernardino');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001017, 1001, ' San Jos&eacute;');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001018, 1001, ' San Juan');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001019, 1001, ' San Pedro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001020, 1001, ' Santa Rosal&iacute;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001021, 1001, ' Santa Teresa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001022, 1001, ' Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001023, 1001, ' 23 de Enero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2001001, 2001, ' Capital Alto Orinoco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2001002, 2001, ' Huachamacare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2001003, 2001, ' Marawaka');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2001004, 2001, ' Mavaca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2001005, 2001, ' Sierra Parima');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2002001, 2002, ' San Fernando de Atabapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2002002, 2002, ' Ucata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2002003, 2002, ' Yapacana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2002004, 2002, ' Caname');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2003001, 2003, ' Puerto Ayacucho');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2003002, 2003, ' Fernando Gir&oacute;n Tovar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2003003, 2003, ' Luis Alberto G&oacute;mez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2003004, 2003, ' Parhue&ntilde;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2003005, 2003, ' Platanillal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2004001, 2004, ' Isla Rat&oacute;n');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2004002, 2004, ' Samariapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2004003, 2004, ' Sipapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2004004, 2004, ' Munduapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2004005, 2004, ' Guayapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2005001, 2005, ' Maroa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2005002, 2005, ' Victorino');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2005003, 2005, ' Comunidad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2006001, 2006, ' San Juan de Manapiare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2006002, 2006, ' Alto Ventuari');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2006003, 2006, ' Medio Ventuari');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2006004, 2006, ' Bajo Ventuari');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2007001, 2007, ' San Carlos de R&iacute;o Negro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2007002, 2007, ' Solano');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2007003, 2007, ' Casiquiare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (2007004, 2007, ' Cocuy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3001001, 3001, ' Anaco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3001002, 3001, ' San Joaqu&iacute;n');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3002001, 3002, ' Aragua de Barcelona');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3002002, 3002, ' Cachipo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3003001, 3003, ' Puerto P&iacute;ritu');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3003002, 3003, ' San Miguel');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3003003, 3003, ' Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3004001, 3004, ' Valle de Guanape');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3004002, 3004, ' Santa B&aacute;rbara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3005001, 3005, ' Pariagu&aacute;n');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3005002, 3005, ' Atapirire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3005003, 3005, ' Boca del Pao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3005004, 3005, ' El Pao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3005005, 3005, ' M&uacute;cura');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3006001, 3006, ' Guanta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3006002, 3006, ' Chorrer&oacute;n');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3007001, 3007, ' Soledad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3007002, 3007, ' Mamo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3008001, 3008, ' Puerto La Cruz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3008002, 3008, ' Pozuelos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3009001, 3009, ' Onoto');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3009002, 3009, ' San Pablo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3010001, 3010, ' Mapire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3010002, 3010, ' Piar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3010003, 3010, ' San Diego de Cabrutica');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3010004, 3010, ' Santa Clara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3010005, 3010, ' Uverito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3010006, 3010, ' Zuata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3011001, 3011, ' San Mateo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3011002, 3011, ' El Carito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3011003, 3011, ' Santa In&eacute;s');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3012001, 3012, ' Clarines');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3012002, 3012, ' Guanape');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3012003, 3012, ' Sabana de Uchire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3013001, 3013, ' Cantaura');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3013002, 3013, ' Libertador');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3013003, 3013, ' Santa Rosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3013004, 3013, ' Urica');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3014001, 3014, ' P&iacute;ritu');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3014002, 3014, ' San Francisco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3015001, 3015, ' San Jos&eacute; de Guanipa El Tigrito)');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3016001, 3016, ' Boca de Uchire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3016002, 3016, ' Boca de Ch&aacute;vez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3017001, 3017, ' Santa Ana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3017002, 3017, ' Pueblo Nuevo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3018001, 3018, ' Barcelona');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3018002, 3018, ' El Carmen');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3018003, 3018, ' San Crist&oacute;bal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3018004, 3018, ' Bergant&iacute;n');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3018005, 3018, ' Caigua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3018006, 3018, ' El Pilar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3018007, 3018, ' Naricual');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3019001, 3019, ' El Tigre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3019002, 3019, ' Edmundo Barrios');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3019003, 3019, ' Miguel Otero Silva');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3020001, 3020, ' El Chaparro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3020002, 3020, ' Tom&aacute;s Alfaro Calatrava');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3021001, 3021, ' Lecher&iacute;as');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (3021002, 3021, ' El Morro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4001001, 4001, ' Achaguas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4001002, 4001, ' Urbana Achaguas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4001003, 4001, ' Apurito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4001004, 4001, ' El Yagual');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4001005, 4001, ' Guachara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4001006, 4001, ' Mucuritas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4001007, 4001, ' Queseras del Medio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4002001, 4002, ' Biruaca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4002002, 4002, ' Urbana Biruaca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4003001, 4003, ' Bruzual');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4003002, 4003, ' Urbana Bruzual');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4003003, 4003, ' Mantecal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4003004, 4003, ' Quintero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4003005, 4003, ' Rincon Hondo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4003006, 4003, ' San Vicente');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4004001, 4004, ' Guasdualito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4004002, 4004, ' Urbana Guasdualito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4004003, 4004, ' Aramendi');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4004004, 4004, ' El Amparo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4004005, 4004, ' San Camilo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4004006, 4004, ' Urdaneta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4005001, 4005, ' San Juan de Payara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4005002, 4005, ' Urbana San Juan de Payara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4005003, 4005, ' Codazzi');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4005004, 4005, ' Cunaviche');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4006001, 4006, ' Elorza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4006002, 4006, ' Urbana Elorza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4006003, 4006, ' La Trinidad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4007001, 4007, ' San Fernando de Apure');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4007002, 4007, ' Urbana San Fernando');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4007003, 4007, ' El Recreo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4007004, 4007, ' Pe&ntilde;alver');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (4007005, 4007, ' San Rafael de Atamaica');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5001001, 5001, ' San Mateo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5002001, 5002, ' Camatagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5002002, 5002, ' Capital Camatagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5002003, 5002, ' No Urbana Carmen de Cura');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003001, 5003, ' Maracay');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003002, 5003, ' No Urbana Choroni');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003003, 5003, ' Urbana Las delicias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003004, 5003, ' Urbana Madre Maria de San Jose');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003005, 5003, ' Urbana Joaquin Crespo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003006, 5003, ' Urbana Pedro Jose Ovalles');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003007, 5003, ' Urbana Jose Casanova Godoy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003008, 5003, ' Urbana Andres Eloy Blanco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5003009, 5003, ' Urbana Los Tacariguas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5004001, 5004, ' Santa Cruz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5005001, 5005, ' La Victoria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5005002, 5005, ' Capital La Victoria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5005003, 5005, ' Urbana Castor Nieves Rios');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5005004, 5005, ' No Urbana Las Guacamayas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5005005, 5005, ' No Urbana Pao de Zarate');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5005006, 5005, ' No Urbana Zuata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5006001, 5006, ' El Consejo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5007001, 5007, ' Palo Negro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5007002, 5007, ' Capital Palo Negro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5007003, 5007, ' No Urbana San Martin de Porres');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5008001, 5008, ' El Limon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5008002, 5008, ' Capital El Limon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5008003, 5008, ' Urbana Ca&ntilde;a de Azucar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5009001, 5009, ' San Casimiro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5009002, 5009, ' Capital San Casimiro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5009003, 5009, ' No Urbana Guiripa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5009004, 5009, ' No Urbana Ollas de Caramacate');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5009005, 5009, ' No Urbana Valle Morin');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5010001, 5010, ' San Sebastian');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5011001, 5011, ' Turmero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5011002, 5011, ' Capital Turmero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5011003, 5011, ' No Urbana Arevalo Aponte');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5011004, 5011, ' No Urbana Chuao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5011005, 5011, ' No Urbana Saman de Guere');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5011006, 5011, ' No Urbana Alfredo Pacheco Miranda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5012001, 5012, ' Las Tejerias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5012002, 5012, ' Capital Las Tejerias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5012003, 5012, ' No Urbana Tiara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5013001, 5013, ' Cagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5013002, 5013, ' Capital Cagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5013003, 5013, ' No Urbana Bella Vista');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5014001, 5014, ' La Colonia Tovar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5015001, 5015, ' Barbacoas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5015002, 5015, ' Capital Barbacoas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5015003, 5015, ' No Urbana Las Pe&ntilde;itas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5015004, 5015, ' No Urbana San Francisco de Cara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5015005, 5015, ' No Urbana Taguay');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5016001, 5016, ' Villa de Cura');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5016002, 5016, ' Capital Villa de Cura');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5016003, 5016, ' No Urbana Magdaleno');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5016004, 5016, ' No Urbana San Francisco de Asis');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5016005, 5016, ' No Urbana Augusto Mijares');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5016006, 5016, ' No Urbana Valles de Tucutunemo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5017001, 5017, ' Santa Rita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5017002, 5017, ' Capital Santa Rita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5017003, 5017, ' No Urbana Francisco de Miranda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5017004, 5017, ' No Urbana Monse&ntilde;or Feliciano Gonz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (5018001, 5018, ' Ocumare de La Costa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6001001, 6001, ' Sabaneta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6001002, 6001, ' Rodriguez Dominguez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6002001, 6002, ' Socopo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6002002, 6002, ' Ticoporo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6002003, 6002, ' Andres Bello');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6002004, 6002, ' Nicolas Pulido');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6003001, 6003, ' Arismendi');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6003002, 6003, ' Guadarrama');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6003003, 6003, ' La Union');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6003004, 6003, ' San Antonio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004001, 6004, ' Barinas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004002, 6004, ' Alfredo Arvelo Larriva');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004003, 6004, ' San Silvestre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004004, 6004, ' Santa Ines');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004005, 6004, ' Santa Lucia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004006, 6004, ' Torunos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004007, 6004, ' El Carmen');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004008, 6004, ' Romulo Betancourt');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004009, 6004, ' Corazon de Jesus');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004010, 6004, ' Ramon Ignacio Mendez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004011, 6004, ' Alto Barinas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004012, 6004, ' Manuel Palacio Fajardo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004013, 6004, ' Juan Antonio Rodriguez Dominguez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6004014, 6004, ' Dominga Ortiz de Paez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6005001, 6005, ' Barinitas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6005002, 6005, ' Altamira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6005003, 6005, ' Calderas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6006001, 6006, ' Barrancas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6006002, 6006, ' El Socorro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6006003, 6006, ' Masparrito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6007001, 6007, ' Santa Barbara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6007002, 6007, ' Jose Ignacio del Pumar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6007003, 6007, ' Pedro Brice&ntilde;o Mendez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6007004, 6007, ' Ramon Ignacio Mendez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6008001, 6008, ' Obispos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6008002, 6008, ' El Real');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6008003, 6008, ' La Luz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6008004, 6008, ' Los Guasimitos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6009001, 6009, ' Ciudad Bolivia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6009002, 6009, ' Ignacio Brice&ntilde;o');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6009003, 6009, ' Jose Felix Ribas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6009004, 6009, ' Paez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6010001, 6010, ' Libertad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6010002, 6010, ' Dolores');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6010003, 6010, ' Palacios Fajardo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6010004, 6010, ' Santa Rosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6011001, 6011, ' Ciudad de Nutrias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6011002, 6011, ' El Regalo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6011003, 6011, ' Puerto de Nutrias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6011004, 6011, ' Santa Catalina');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6012001, 6012, ' El Canton');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6012002, 6012, ' Santa Cruz de Guacas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (6012003, 6012, ' Puerto Vivas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001001, 7001, ' Ciudad Guayana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001002, 7001, ' Cachamay');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001003, 7001, ' Chirica');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001004, 7001, ' Dalla Costa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001005, 7001, ' Once de Abril');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001006, 7001, ' Simon Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001007, 7001, ' Unare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001008, 7001, ' Universidad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001009, 7001, ' Vista Al Sol');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001010, 7001, ' Pozo Verde');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001011, 7001, ' Yocoima');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7001012, 7001, ' San Felix');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7002001, 7002, ' Caicara del Orinoco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7002002, 7002, ' Seccion Capital Cede&ntilde;o');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7002003, 7002, ' Altagracia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7002004, 7002, ' Ascension Farreras');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7002005, 7002, ' Guaniamo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7002006, 7002, ' La Urbana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7002007, 7002, ' Pijiguaos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7003001, 7003, ' El Callao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7004001, 7004, ' Santa Elena de Uairen');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7004002, 7004, ' Seccion Capital Gran Sabana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7004003, 7004, ' Ikabaru');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005001, 7005, ' Ciudad Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005002, 7005, ' Agua Salada');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005003, 7005, ' Catedral');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005004, 7005, ' Jose Antonio Paez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005005, 7005, ' La Sabanita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005006, 7005, ' Marhuanta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005007, 7005, ' Vista Hermosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005008, 7005, ' Orinoco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005009, 7005, ' Panapana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7005010, 7005, ' Zea');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7006001, 7006, ' Upata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7006002, 7006, ' Seccion Capital Piar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7006003, 7006, ' Andres Eloy Blanco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7006004, 7006, ' Pedro Cova');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7007001, 7007, ' Ciudad Piar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7007002, 7007, ' Seccion Capital Raul Leoni');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7007003, 7007, ' Barceloneta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7007004, 7007, ' San Francisco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7007005, 7007, ' Santa Barbara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7008001, 7008, ' Guasipati');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7008002, 7008, ' Seccion Capital Roscio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7008003, 7008, ' Salom');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7009001, 7009, ' Tumeremo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7009002, 7009, ' Seccion Capital Sifontes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7009003, 7009, ' Dalla Costa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7009004, 7009, ' San Isidro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7010001, 7010, ' Maripa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7010002, 7010, ' Seccion Capital Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7010003, 7010, ' Aripao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7010004, 7010, ' Guarataro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7010005, 7010, ' Las Majadas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7010006, 7010, ' Moitaco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (7011001, 7011, ' El Palmar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8001001, 8001, ' Bejuma');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8001002, 8001, ' Urbana Bejuma');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8001003, 8001, ' No Urbana Canoabo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8001004, 8001, ' No Urbana Simon Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8002001, 8002, ' Guigue');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8002002, 8002, ' Urbana Guigue');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8002003, 8002, ' No Urbana Belen');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8002004, 8002, ' No Urbana Tacarigua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8003001, 8003, ' Mariara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8003002, 8003, ' Urbana Aguas Calientes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8003003, 8003, ' Urbana Mariara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8004001, 8004, ' Guacara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8004002, 8004, ' Urbana Ciudad Alianza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8004003, 8004, ' Urbana Guacara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8004004, 8004, ' No Urbana Yagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8005001, 8005, ' Moron');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8005002, 8005, ' Urbana Moron');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8005003, 8005, ' No Urbana Urama');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8006001, 8006, ' Tocuyito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8006002, 8006, ' Urbana Tocuyito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8006003, 8006, ' Urbana Independencia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8007001, 8007, ' Los Guayos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8007002, 8007, ' Urbana Los Guayos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8008001, 8008, ' Miranda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8008002, 8008, ' Urbana Miranda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8009001, 8009, ' Montalban');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8009002, 8009, ' Urbana Montalban');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8010001, 8010, ' Naguanagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8010002, 8010, ' Urbana Naguanagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011001, 8011, ' Puerto Cabello');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011002, 8011, ' Urbana Bartolome Salom');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011003, 8011, ' Urbana democracia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011004, 8011, ' Urbana Fraternidad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011005, 8011, ' Urbana Goaigoaza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011006, 8011, ' Urbana Juan Jose Flores');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011007, 8011, ' Urbana Union');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011008, 8011, ' No Urbana Borburata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8011009, 8011, ' No Urbana Patanemo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8012001, 8012, ' San Diego');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8012002, 8012, ' Urbana San Diego');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8013001, 8013, ' San Joaquin');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8013002, 8013, ' Urbana San Joaquin');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014001, 8014, ' Valencia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014002, 8014, ' Urbana Candelaria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014003, 8014, ' Urbana Catedral');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014004, 8014, ' Urbana El Socorro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014005, 8014, ' Urbana Miguel Pe&ntilde;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014006, 8014, ' Urbana Rafael Urdaneta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014007, 8014, ' Urbana San Blas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014008, 8014, ' Urbana San Jose');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014009, 8014, ' Urbana Santa Rosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8014010, 8014, ' No Urbana Negro Primero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (8015001, 8015, ' Valencia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9001001, 9001, ' Cojedes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9001002, 9001, ' Juan de Mata Suarez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9002001, 9002, ' Tinaquillo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9003001, 9003, ' El Baul');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9003002, 9003, ' Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9004001, 9004, ' Macapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9004002, 9004, ' La Aguadita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9005001, 9005, ' El Pao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9006001, 9006, ' Libertad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9006002, 9006, ' Libertad de Cojedes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9006003, 9006, ' El Amparo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9007001, 9007, ' Las Vegas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9007002, 9007, ' Romulo Gallegos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9008001, 9008, ' San Carlos Cojedes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9008002, 9008, ' San Carlos de Austria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9008003, 9008, ' Juan Angel Bravo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9008004, 9008, ' Manuel Manrique');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9009001, 9009, ' Tinaco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (9009002, 9009, ' General En Jefe Jose Laurencio Si');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10001001, 10001, ' Curiapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10001002, 10001, ' Almirante Luis Brion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10001003, 10001, ' Francisco Aniceto Lugo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10001004, 10001, ' Manuel Renaud');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10001005, 10001, ' Padre Barral');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10001006, 10001, ' Santos de Abelgas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10002001, 10002, ' Sierra Imataca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10002002, 10002, ' Imataca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10002003, 10002, ' Cinco de Julio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10002004, 10002, ' Juan Bautista Arismendi');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10002005, 10002, ' Manuel Piar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10002006, 10002, ' Romulo Gallegos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10003001, 10003, ' Pedernales');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10003002, 10003, ' Luis Beltran Prieto Figueroa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004001, 10004, ' Tucupita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004002, 10004, ' San Jose');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004003, 10004, ' Jose Vidal Marcano');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004004, 10004, ' Juan Millan');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004005, 10004, ' Leonardo Ruiz Pineda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004006, 10004, ' Mariscal Antonio Jose de Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004007, 10004, ' Monse&ntilde;or Argimiro Garcia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004008, 10004, ' San Rafael');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (10004009, 10004, ' Virgen del Valle');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11001001, 11001, ' San Juan de Los Cayos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11001002, 11001, ' Capadare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11001003, 11001, ' La Pastora');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11001004, 11001, ' Libertador');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11002001, 11002, ' San Luis');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11002002, 11002, ' Aracua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11002003, 11002, ' La Pe&ntilde;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11003001, 11003, ' Capatarida');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11003002, 11003, ' Bariro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11003003, 11003, ' Borojo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11003004, 11003, ' Guajiro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11003005, 11003, ' Seque');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11003006, 11003, ' Zazarida');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11004001, 11004, ' Yaracal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11005001, 11005, ' Punto Fijo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11005002, 11005, ' Carirubana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11005003, 11005, ' Norte');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11005004, 11005, ' Punta Cardon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11005005, 11005, ' Santa Ana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11006001, 11006, ' La Vela de Coro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11006002, 11006, ' Acurigua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11006003, 11006, ' Guaibacoa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11006004, 11006, ' Las Calderas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11006005, 11006, ' Macoruca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11007001, 11007, ' Dabajuro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11008001, 11008, ' Pedregal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11008002, 11008, ' Agua Clara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11008003, 11008, ' Avaria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11008004, 11008, ' Piedra Grande');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11008005, 11008, ' Purureche');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009001, 11009, ' Pueblo Nuevo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009002, 11009, ' Adicora');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009003, 11009, ' Baraived');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009004, 11009, ' Buena Vista');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009005, 11009, ' Jadacaquiva');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009006, 11009, ' Moruy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009007, 11009, ' Adaure');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009008, 11009, ' El Hato');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11009009, 11009, ' El Vinculo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11010001, 11010, ' Churuguara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11010002, 11010, ' Agua Larga');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11010003, 11010, ' Pauji');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11010004, 11010, ' Independencia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11010005, 11010, ' Maparari');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11011001, 11011, ' Jacura');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11011002, 11011, ' Agua Linda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11011003, 11011, ' Araurima');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11012001, 11012, ' Santa Cruz de Los Taques');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11012002, 11012, ' Los Taques');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11012003, 11012, ' Judibana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11013001, 11013, ' Mene de Mauroa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11013002, 11013, ' Casigua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11013003, 11013, ' San Felix');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11014001, 11014, ' Santa Ana de Coro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11014002, 11014, ' San Antonio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11014003, 11014, ' San Gabriel');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11014004, 11014, ' Santa Ana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11014005, 11014, ' Guzman Guillermo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11014006, 11014, ' Mitare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11014007, 11014, ' Rio Seco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11014008, 11014, ' Sabaneta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11015001, 11015, ' Chichiriviche');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11015002, 11015, ' Boca de Tocuyo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11015003, 11015, ' Tocuyo de La Costa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11016001, 11016, ' Palmasola');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11017001, 11017, ' Cabure');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11017002, 11017, ' Colina');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11017003, 11017, ' Curimagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11018001, 11018, ' Piritu');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11018002, 11018, ' San Jose de La Costa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11019001, 11019, ' Mirimire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11020001, 11020, ' Tucacas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11020002, 11020, ' Boca de Aroa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11021001, 11021, ' La Cruz de Taratara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11021002, 11021, ' Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11021003, 11021, ' Pecaya');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11022001, 11022, ' Tocopero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11023001, 11023, ' Santa Cruz de Bucaral');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11023002, 11023, ' El Charal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11023003, 11023, ' Las Vegas del Tuy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11024001, 11024, ' Urumaco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11024002, 11024, ' Bruzual');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11025001, 11025, ' Puerto Cumarebo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11025002, 11025, ' La Cienaga');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11025003, 11025, ' La Soledad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11025004, 11025, ' Pueblo Cumarebo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (11025005, 11025, ' Zazarida');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12001001, 12001, ' Camaguan');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12001002, 12001, ' Puerto Miranda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12001003, 12001, ' Uverito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12002001, 12002, ' Chaguaramas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12003001, 12003, ' El Socorro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12004001, 12004, ' Guayabal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12004002, 12004, ' Cazorla');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12005001, 12005, ' Valle de La Pascua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12005002, 12005, ' Espino');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12006001, 12006, ' Las Mercedes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12006002, 12006, ' Cabruta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12006003, 12006, ' Santa Rita de Manapire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12007001, 12007, ' El Sombrero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12007002, 12007, ' Sosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12008001, 12008, ' Calabozo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12008002, 12008, ' El Calvario');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12008003, 12008, ' El Rastro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12008004, 12008, ' Guardatinajas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12009001, 12009, ' Altagracia de Orituco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12009002, 12009, ' Lezama');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12009003, 12009, ' Libertad de Orituco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12009004, 12009, ' Paso Real de Macaira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12009005, 12009, ' San Francisco de Macaira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12009006, 12009, ' San Rafael de Orituco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12009007, 12009, ' Soublette');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12010001, 12010, ' Ortiz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12010002, 12010, ' Zaraza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12010003, 12010, ' San Francisco de Tiznados');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12010004, 12010, ' San Jose de Tiznados');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12010005, 12010, ' San Lorenzo de Tiznados');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12011001, 12011, ' Tucupido');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12011002, 12011, ' San Rafael de Laya');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12012001, 12012, ' San Juan de Los Morros');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12012002, 12012, ' Cantagallo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12012003, 12012, ' Parapara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12013001, 12013, ' San Jose de Guaribe');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12014001, 12014, ' Santa Maria de Ipire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12014002, 12014, ' Altamira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12015001, 12015, ' Zaraza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (12015002, 12015, ' San Jose de Unare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13001001, 13001, ' Sanare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13001002, 13001, ' Pio Tamayo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13001003, 13001, ' Quebrada Honda de Guache');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13001004, 13001, ' Yacambu');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13002001, 13002, ' Duaca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13002002, 13002, ' Freitez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13002003, 13002, ' Jose Maria Blanco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003001, 13003, ' Barquisimeto');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003002, 13003, ' Catedral');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003003, 13003, ' Concepcion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003004, 13003, ' El Cuji');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003005, 13003, ' Juan de Villegas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003006, 13003, ' Santa Rosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003007, 13003, ' Tamaca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003008, 13003, ' Union');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003009, 13003, ' Aguedo Felipe Alvarado');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003010, 13003, ' Buena Vista');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13003011, 13003, ' Juarez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004001, 13004, ' Quibor');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004002, 13004, ' Juan Bautista Rodriguez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004003, 13004, ' Cuara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004004, 13004, ' Diego de Lozada');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004005, 13004, ' Paraiso de San Jose');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004006, 13004, ' San Miguel');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004007, 13004, ' Tintorero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004008, 13004, ' Jose Bernardo Dorante');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13004009, 13004, ' Coronel Mariano Peraza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005001, 13005, ' El Tocuyo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005002, 13005, ' Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005003, 13005, ' Anzoategui');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005004, 13005, ' Guarico');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005005, 13005, ' Hilario Luna Y Luna');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005006, 13005, ' Humocaro Alto');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005007, 13005, ' Humocaro Bajo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005008, 13005, ' La Candelaria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13005009, 13005, ' Moran');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13006001, 13006, ' Cabudare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13006002, 13006, ' Jose Gregorio Bastidas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13006003, 13006, ' Agua Viva');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13007001, 13007, ' Sarare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13007002, 13007, ' Buria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13007003, 13007, ' Gustavo Vegas Leon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008001, 13008, ' Carora');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008002, 13008, ' Trinidad Samuel');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008003, 13008, ' Antonio Diaz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008004, 13008, ' Camacaro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008005, 13008, ' Casta&ntilde;eda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008006, 13008, ' Cecilio Zubillaga');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008007, 13008, ' Chiquinquira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008008, 13008, ' El Blanco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008009, 13008, ' Espinoza de Los Monteros');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008010, 13008, ' Lara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008011, 13008, ' Las Mercedes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008012, 13008, ' Manuel Morillo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008013, 13008, ' Monta&ntilde;a Verde');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008014, 13008, ' Montes de Oca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008015, 13008, ' Torres');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008016, 13008, ' Heriberto Arroyo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008017, 13008, ' Reyes Vargas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13008018, 13008, ' Altagracia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13009001, 13009, ' Siquisique');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13009002, 13009, ' Moroturo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13009003, 13009, ' San Miguel');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (13009004, 13009, ' Xaguas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14001001, 14001, ' El Vigia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14001002, 14001, ' Presidente Betancourt');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14001003, 14001, ' Presidente Paez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14001004, 14001, ' Presidente Romulo Gallegos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14001005, 14001, ' Gabriel Picon Gonzalez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14001006, 14001, ' Hector Amable Mora');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14001007, 14001, ' Jose Nucete Sardi');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14001008, 14001, ' Pulido Mendez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14002001, 14002, ' La Azulita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14003001, 14003, ' Santa Cruz de Mora');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14003002, 14003, ' Mesa Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14003003, 14003, ' Mesa de Las Palmas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14004001, 14004, ' Aricagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14004002, 14004, ' San Antonio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14005001, 14005, ' Canagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14005002, 14005, ' Capuri');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14005003, 14005, ' Chacanta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14005004, 14005, ' El Molino');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14005005, 14005, ' Guaimaral');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14005006, 14005, ' Mucutuy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14005007, 14005, ' Mucuchachi');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14006001, 14006, ' Ejido');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14006002, 14006, ' Fernandez Pe&ntilde;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14006003, 14006, ' Matriz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14006004, 14006, ' Montalban');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14006005, 14006, ' Acequias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14006006, 14006, ' Jaji');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14006007, 14006, ' La Mesa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14006008, 14006, ' San Jose del Sur');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14007001, 14007, ' Tucani');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14007002, 14007, ' Florencio Ramirez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14008001, 14008, ' Santo Domingo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14008002, 14008, ' Las Piedras');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14009001, 14009, ' Guaraque');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14009002, 14009, ' Mesa de Quintero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14009003, 14009, ' Rio Negro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14010001, 14010, ' Arapuey');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14010002, 14010, ' Palmira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14011001, 14011, ' Torondoy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14011002, 14011, ' San Cristobal de Torondoy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012001, 14012, ' Merida');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012002, 14012, ' Antonio Spinetti Dini');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012003, 14012, ' Arias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012004, 14012, ' Caracciolo Parra Perez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012005, 14012, ' Domingo Pe&ntilde;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012006, 14012, ' El Llano');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012007, 14012, ' Gonzalo Picon Febres');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012008, 14012, ' Jacinto Plaza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012009, 14012, ' Juan Rodriguez Suarez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012010, 14012, ' Lasso de La Vega');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012011, 14012, ' Mariano Picon Salas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012012, 14012, ' Milla');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012013, 14012, ' Osuna Rodriguez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012014, 14012, ' Sagrario');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012015, 14012, ' El Morro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14012016, 14012, ' Los Nevados');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14013001, 14013, ' Timotes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14013002, 14013, ' Andres Eloy Blanco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14013003, 14013, ' La Venta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14013004, 14013, ' Pi&ntilde;ango');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14014001, 14014, ' Santa Elena de Arenales');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14014002, 14014, ' Eloy Paredes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14014003, 14014, ' San Rafael de Alcazar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14015001, 14015, ' Santa Maria de Caparo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14016001, 14016, ' Pueblo Llano');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14017001, 14017, ' Mucuchies');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14017002, 14017, ' Cacute');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14017003, 14017, ' La Toma');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14017004, 14017, ' Mucuruba');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14017005, 14017, ' San Rafael');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14018001, 14018, ' Bailadores');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14018002, 14018, ' Geronimo Maldonado');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14019001, 14019, ' Tabay');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14020001, 14020, ' Lagunillas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14020002, 14020, ' Chiguara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14020003, 14020, ' Estanquez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14020004, 14020, ' La Trampa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14020005, 14020, ' Pueblo Nuevo del Sur');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14020006, 14020, ' San Juan');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14021001, 14021, ' Tovar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14021002, 14021, ' El Amparo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14021003, 14021, ' El Llano');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14021004, 14021, ' San Francisco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14022001, 14022, ' Nueva Bolivia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14022002, 14022, ' Independencia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14022003, 14022, ' Maria de La Concepcion Palacios B');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14022004, 14022, ' Santa Apolonia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14023001, 14023, ' Zea');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (14023002, 14023, ' Ca&ntilde;o El Tigre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15001001, 15001, ' Caucagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15001002, 15001, ' Araguita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15001003, 15001, ' Arevalo Gonzalez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15001004, 15001, ' Capaya');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15001005, 15001, ' El Cafe');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15001006, 15001, ' Marizapa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15001007, 15001, ' Panaquire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15001008, 15001, ' Ribas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15002001, 15002, ' San Jose de Barlovento');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15002002, 15002, ' Cumbo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15003002, 15003, ' Baruta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15003003, 15003, ' El Cafetal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15003004, 15003, ' Las Minas de Baruta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15004001, 15004, ' Higuerote');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15004002, 15004, ' Curiepe');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15004003, 15004, ' Tacarigua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15005001, 15005, ' Mamporal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15006001, 15006, ' Carrizal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15007001, 15007, ' Chacao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15008001, 15008, ' Charallave');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15008002, 15008, ' Las Brisas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15009001, 15009, ' El Hatillo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15010001, 15010, ' Los Teques');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15010002, 15010, ' Altagracia de La Monta&ntilde;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15010003, 15010, ' Cecilio Acosta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15010004, 15010, ' El Jarillo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15010005, 15010, ' Paracotos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15010006, 15010, ' San Pedro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15010007, 15010, ' Tacata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15011001, 15011, ' Santa Teresa del Tuy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15011002, 15011, ' El Cartanal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15012001, 15012, ' Ocumare del Tuy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15012002, 15012, ' La democracia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15012003, 15012, ' Santa Barbara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15013001, 15013, ' San Antonio de Los Altos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15014001, 15014, ' Rio Chico');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15014002, 15014, ' El Guapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15014003, 15014, ' Tacarigua de La Laguna');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15014004, 15014, ' Paparo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15014005, 15014, ' San Fernando del Guapo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15015001, 15015, ' Santa Lucia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15016001, 15016, ' Cupira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15016002, 15016, ' Machurucuto');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15017001, 15017, ' Guarenas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15018001, 15018, ' San Francisco de Yare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15018002, 15018, ' San Antonio de Yare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15019001, 15019, ' Petare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15019002, 15019, ' Caucaguita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15019003, 15019, ' Fila de Mariches');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15019004, 15019, ' La Dolorita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15019005, 15019, ' Leoncio Martinez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15020001, 15020, ' Cua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15020002, 15020, ' Nueva Cua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15021001, 15021, ' Guatire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15021002, 15021, ' Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16001001, 16001, ' San Antonio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16001002, 16001, ' San Francisco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16002001, 16002, ' Aguasay');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16003001, 16003, ' Caripito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16004001, 16004, ' Caripe');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16004002, 16004, ' El Guacharo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16004003, 16004, ' La Guanota');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16004004, 16004, ' Sabana de Piedra');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16004005, 16004, ' San Agustin');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16004006, 16004, ' Teresen');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16005001, 16005, ' Caicara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16005002, 16005, ' Areo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16005003, 16005, ' San Felix');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16005004, 16005, ' Viento Fresco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16006001, 16006, ' Punta de Mata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16006002, 16006, ' El Tejero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16007001, 16007, ' Temblador');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16007002, 16007, ' Chaguaramas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16007003, 16007, ' Las Alhuacas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16007004, 16007, ' Tabasca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008001, 16008, ' Maturin');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008002, 16008, ' Alto de Los Godos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008003, 16008, ' Boqueron');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008004, 16008, ' Las Cocuizas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008005, 16008, ' San Simon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008006, 16008, ' Santa Cruz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008007, 16008, ' El Corozo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008008, 16008, ' El Furrial');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008009, 16008, ' Jusepin');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008010, 16008, ' La Pica');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16008011, 16008, ' San Vicente');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16009001, 16009, ' Aragua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16009002, 16009, ' Aparicio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16009003, 16009, ' Chaguaramal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16009004, 16009, ' El Pinto');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16009005, 16009, ' Guanaguana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16009006, 16009, ' La Toscana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16009007, 16009, ' Taguaya');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16010001, 16010, ' Quiriquire');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16010002, 16010, ' Cachipo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16011001, 16011, ' Santa Barbara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16012001, 16012, ' Barrancas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16012002, 16012, ' Los Barrancos de Fajardo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (16013001, 16013, ' Uracoa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17001001, 17001, ' La Plaza de Paraguachi');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17002001, 17002, ' La Asuncion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17003001, 17003, ' San Juan Bautista');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17003002, 17003, ' Zabala');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17004001, 17004, ' El Valle del Espiritu Santo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17004002, 17004, ' Francisco Fajardo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17005001, 17005, ' Santa Ana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17005002, 17005, ' Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17005003, 17005, ' Guevara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17005004, 17005, ' Matasiete');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17005005, 17005, ' Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17006001, 17006, ' Pampatar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17006002, 17006, ' Aguirre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17007001, 17007, ' Juangriego');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17007002, 17007, ' Adrian');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17008001, 17008, ' Porlamar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17009001, 17009, ' Boca del Rio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17009002, 17009, ' San Francisco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17010001, 17010, ' Punta de Piedras');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17010002, 17010, ' Los Barales');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17011001, 17011, ' San Pedro de Coche');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (17011002, 17011, ' Vicente Fuentes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18001001, 18001, ' Agua Blanca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18002001, 18002, ' Araure');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18002002, 18002, ' Rio Acarigua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18003001, 18003, ' Piritu');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18003002, 18003, ' Uveral');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18004001, 18004, ' Guanare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18004002, 18004, ' Cordoba');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18004003, 18004, ' San Jose de La Monta&ntilde;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18004004, 18004, ' San Juan de Guanaguanare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18004005, 18004, ' Virgen de La Coromoto');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18005001, 18005, ' Guanarito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18005002, 18005, ' Trinidad de La Capilla');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18005003, 18005, ' Divina Pastora');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18006001, 18006, ' Paraiso de Chabasquen');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18006002, 18006, ' Pe&ntilde;a Blanca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18007001, 18007, ' Ospino');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18007002, 18007, ' Aparicion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18007003, 18007, ' La Estacion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18008001, 18008, ' Acarigua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18008002, 18008, ' Payara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18008003, 18008, ' Pimpinela');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18008004, 18008, ' Ramon Peraza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18009001, 18009, ' Papelon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18009002, 18009, ' Ca&ntilde;o delgadito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18010001, 18010, ' Boconoito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18010002, 18010, ' Antolin Tovar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18011001, 18011, ' San Rafael de Onoto');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18011002, 18011, ' Santa Fe');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18011003, 18011, ' Thermo Morles');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18012001, 18012, ' El Playon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18012002, 18012, ' Florida');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18013001, 18013, ' Biscucuy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18013002, 18013, ' Concepcion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18013003, 18013, ' San Rafael de Palo Alzado');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18013004, 18013, ' Uvencio Antonio Velasquez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18013005, 18013, ' San Jose de Saguaz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18013006, 18013, ' Villa Rosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18014001, 18014, ' Villa Bruzual');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18014002, 18014, ' Canelones');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18014003, 18014, ' Santa Cruz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (18014004, 18014, ' San Isidro Labrador');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19001001, 19001, ' Casanay');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19001002, 19001, ' Mari&ntilde;o');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19001003, 19001, ' Romulo Gallegos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19002001, 19002, ' San Jose de Aerocuar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19002002, 19002, ' Tavera Acosta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19003001, 19003, ' Rio Caribe');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19003002, 19003, ' Antonio Jose de Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19003003, 19003, ' El Morro de Puerto Santo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19003004, 19003, ' Puerto Santo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19003005, 19003, ' San Juan de Las Galdonas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19004001, 19004, ' El Pilar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19004003, 19004, ' General Francisco Antonio Vasquez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19004004, 19004, ' Guaraunos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19004005, 19004, ' Tunapuicito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19004006, 19004, ' Union');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19005002, 19005, ' Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19005003, 19005, ' Macarapana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19005004, 19005, ' Santa Catalina');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19005005, 19005, ' Santa Rosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19005006, 19005, ' Santa Teresa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19006001, 19006, ' Mariguitar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19007001, 19007, ' Yaguaraparo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19007002, 19007, ' El Paujil');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19007003, 19007, ' Libertad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19008001, 19008, ' Araya');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19008002, 19008, ' Chacopata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19008003, 19008, ' Manicuare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19009001, 19009, ' Tunapuy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19009002, 19009, ' Campo Elias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19010001, 19010, ' Irapa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19010002, 19010, ' Campo Claro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19010003, 19010, ' Marabal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19010004, 19010, ' San Antonio de Irapa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19010005, 19010, ' Soro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19011001, 19011, ' San Antonio del Golfo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19012001, 19012, ' Cumanacoa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19012002, 19012, ' Arenas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19012003, 19012, ' Aricagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19012004, 19012, ' Cocollar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19012005, 19012, ' San Fernando');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19012006, 19012, ' San Lorenzo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19013001, 19013, ' Cariaco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19013002, 19013, ' Catuaro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19013003, 19013, ' Rendon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19013004, 19013, ' Santa Cruz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19013005, 19013, ' Santa Maria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19014001, 19014, ' Cumana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19014002, 19014, ' Altagracia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19014003, 19014, ' Ayacucho');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19014004, 19014, ' Santa Ines');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19014005, 19014, ' Valentin Valiente');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19014006, 19014, ' San Juan');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19014007, 19014, ' Raul Leoni');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19014008, 19014, ' Santa Fe');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19015001, 19015, ' Guiria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19015002, 19015, ' Bideau');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19015003, 19015, ' Cristobal Colon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19015004, 19015, ' Punta de Piedras');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20001001, 20001, ' Cordero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20002001, 20002, ' Las Mesas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20003001, 20003, ' Colon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20003002, 20003, ' Rivas Berti');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20003003, 20003, ' San Pedro del Rio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20004001, 20004, ' San Antonio del Tachira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20004002, 20004, ' Palotal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20004003, 20004, ' Juan Vicente Gomez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20004004, 20004, ' Isaias Medina Angarita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20005001, 20005, ' Tariba');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20005002, 20005, ' Amenodoro Rangel Lamus');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20005003, 20005, ' La Florida');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20006001, 20006, ' Santa Ana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20007001, 20007, ' San Rafael del Pi&ntilde;al');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20007002, 20007, ' Alberto Adriani');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20007003, 20007, ' Santo Domingo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20008001, 20008, ' San Jose de Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20009001, 20009, ' La Fria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20009002, 20009, ' Boca de Grita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20009003, 20009, ' Jose Antonio Paez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20010001, 20010, ' Palmira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20011001, 20011, ' Capacho Nuevo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20011002, 20011, ' Juan German Roscio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20011003, 20011, ' Roman Cardenas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20012001, 20012, ' La Grita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20012002, 20012, ' Emilio Constantino Guerrero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20012003, 20012, ' Monse&ntilde;or Miguel Antonio Salas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20013001, 20013, ' El Cobre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20014001, 20014, ' Rubio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20014002, 20014, ' La Petrolea');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20014003, 20014, ' Quinimari');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20014004, 20014, ' Bramon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20015001, 20015, ' Capacho Viejo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20015002, 20015, ' Cipriano Castro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20015003, 20015, ' Manuel Felipe Rugeles');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20016001, 20016, ' Abejales');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20016002, 20016, ' Emeterio Ochoa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20016003, 20016, ' Doradas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20016004, 20016, ' San Joaquin de Navay');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20017001, 20017, ' Lobatera');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20017002, 20017, ' Constitucion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20018001, 20018, ' Michelena');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20019001, 20019, ' Coloncito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20019002, 20019, ' La Palmita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20020001, 20020, ' Ure&ntilde;a');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20020002, 20020, ' Nueva Arcadia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20021001, 20021, ' delicias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20022001, 20022, ' La Tendida');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20022002, 20022, ' Bocono');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20022003, 20022, ' Hernandez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20023001, 20023, ' San Cristobal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20023002, 20023, ' La Concordia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20023003, 20023, ' Pedro Maria Morantes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20023004, 20023, ' San Juan Bautista');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20023005, 20023, ' San Sebastian');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20023006, 20023, ' Dr. Francisco Romero Lobo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20024001, 20024, ' Seboruco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20025001, 20025, ' San Simon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20026001, 20026, ' Queniquea');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20026002, 20026, ' Eleazar Lopez Contreras');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20026003, 20026, ' San Pablo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20027001, 20027, ' San Josecito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20028001, 20028, ' Pregonero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20028002, 20028, ' Cardenas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20028003, 20028, ' Juan Pablo Pe&ntilde;aloza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20028004, 20028, ' Potosi');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (20029001, 20029, ' Umuquena');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21001001, 21001, ' Santa Isabel');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21001002, 21001, ' Araguaney');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21001003, 21001, ' El Jaguito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21001004, 21001, ' La Esperanza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002001, 21002, ' Bocono');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002002, 21002, ' El Carmen');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002003, 21002, ' Mosquey');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002004, 21002, ' Ayacucho');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002005, 21002, ' Burbusay');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002006, 21002, ' General Rivas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002007, 21002, ' Guaramacal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002008, 21002, ' Vega de Guaramacal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002009, 21002, ' Monse&ntilde;or Jauregui');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002010, 21002, ' Rafael Rangel');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002011, 21002, ' San Miguel');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21002012, 21002, ' San Jose');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21003001, 21003, ' Sabana Grande');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21003002, 21003, ' Cheregue');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21003003, 21003, ' Granados');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21004001, 21004, ' Chejende');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21004002, 21004, ' Arnoldo Gabaldon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21004003, 21004, ' Bolivia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21004004, 21004, ' Carrillo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21004005, 21004, ' Cegarra');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21004006, 21004, ' Manuel Salvador Ulloa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21004007, 21004, ' San Jose');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21005001, 21005, ' Carache');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21005002, 21005, ' Cuicas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21005003, 21005, ' La Concepcion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21005004, 21005, ' Panamericana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21005005, 21005, ' Santa Cruz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21006001, 21006, ' Escuque');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21006002, 21006, ' La Union');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21006003, 21006, ' Sabana Libre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21006004, 21006, ' Santa Rita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21007001, 21007, ' El Paradero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21007002, 21007, ' El Socorro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21007003, 21007, ' Antonio Jose de Sucre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21007004, 21007, ' Los Caprichos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21008001, 21008, ' Campo Elias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21008002, 21008, ' Arnoldo Gabaldon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21009001, 21009, ' Santa Apolonia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21009002, 21009, ' El Progreso');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21009003, 21009, ' La Ceiba');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21009004, 21009, ' Tres de Febrero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21010001, 21010, ' El Dividive');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21010002, 21010, ' Agua Santa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21010003, 21010, ' Agua Caliente');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21010004, 21010, ' El Cenizo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21010005, 21010, ' Valerita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21011001, 21011, ' Monte Carmelo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21011002, 21011, ' Buena Vista');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21011003, 21011, ' Santa Maria del Horcon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21012001, 21012, ' Motatan');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21012002, 21012, ' El Ba&ntilde;o');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21012003, 21012, ' Jalisco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21013001, 21013, ' Pampan');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21013002, 21013, ' Flor de Patria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21013003, 21013, ' La Paz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21013004, 21013, ' Santa Ana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21014001, 21014, ' Pampanito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21014002, 21014, ' La Concepcion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21014003, 21014, ' Pampanito Ii');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21015001, 21015, ' Betijoque');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21015002, 21015, ' La Pueblita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21015003, 21015, ' Los Cedros');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21015004, 21015, ' Jose Gregorio Hernandez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21016001, 21016, ' Carvajal');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21016002, 21016, ' Antonio Nicolas Brice&ntilde;o');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21016003, 21016, ' Campo Alegre');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21016004, 21016, ' Jose Leonardo Suarez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21017001, 21017, ' Sabana de Mendoza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21017002, 21017, ' El Paraiso');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21017003, 21017, ' Junin');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21017004, 21017, ' Valmore Rodriguez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21018001, 21018, ' Trujillo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21018002, 21018, ' Andres Linares');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21018003, 21018, ' Chiquinquira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21018004, 21018, ' Cristobal Mendoza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21018005, 21018, ' Cruz Carrillo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21018006, 21018, ' Matriz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21018007, 21018, ' Monse&ntilde;or Carrillo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21018008, 21018, ' Tres Esquinas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21019001, 21019, ' La Quebrada');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21019002, 21019, ' Cabimbu');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21019003, 21019, ' Jajo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21019004, 21019, ' La Mesa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21019005, 21019, ' Santiago');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21019006, 21019, ' Tu&ntilde;ame');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21020001, 21020, ' Valera');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21020002, 21020, ' Juan Ignacio Montilla');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21020003, 21020, ' La Beatriz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21020004, 21020, ' Mercedes Diaz');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21020005, 21020, ' San Luis');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21020006, 21020, ' La Puerta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (21020007, 21020, ' Mendoza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22001001, 22001, ' San Pablo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22002001, 22002, ' Aroa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22003001, 22003, ' Chivacoa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22003002, 22003, ' Campo Elias');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22004001, 22004, ' Cocorote');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22005001, 22005, ' Independencia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22006001, 22006, ' Sabana de Parra');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22007001, 22007, ' Boraure');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22008001, 22008, ' Yumare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22009001, 22009, ' Nirgua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22009002, 22009, ' Salom');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22009003, 22009, ' Temerla');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22010001, 22010, ' Yaritagua');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22010002, 22010, ' San Andres');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22011001, 22011, ' San Felipe');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22011002, 22011, ' Albarico');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22011003, 22011, ' San Javier');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22012001, 22012, ' Guama');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22013001, 22013, ' Urachiche');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22014001, 22014, ' Farriar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (22014002, 22014, ' El Guayabo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23001001, 23001, ' El Toro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23001002, 23001, ' Isla de Toas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23001003, 23001, ' Monagas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23002001, 23002, ' San Timoteo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23002002, 23002, ' General Urdaneta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23002003, 23002, ' Libertador');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23002004, 23002, ' Manuel Guanipa Matos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23002005, 23002, ' Marcelino Brice&ntilde;o');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23002006, 23002, ' Pueblo Nuevo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003001, 23003, ' Cabimas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003002, 23003, ' Ambrosio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003003, 23003, ' Carmen Herrera');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003004, 23003, ' German Rios Linares');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003005, 23003, ' La Rosa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003006, 23003, ' Jorge Hernandez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003007, 23003, ' Romulo Betancourt');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003008, 23003, ' San Benito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003009, 23003, ' Aristides Calvani');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23003010, 23003, ' Punta Gorda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23004001, 23004, ' Encontrados');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23004002, 23004, ' Udon Perez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23005001, 23005, ' San Carlos del Zulia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23005002, 23005, ' Moralito');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23005003, 23005, ' Santa Barbara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23005004, 23005, ' Santa Cruz del Zulia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23005005, 23005, ' Urribarri');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23006001, 23006, ' Pueblo Nuevo El Chivo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23006002, 23006, ' Simon Rodriguez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23006003, 23006, ' Carlos Quevedo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23006004, 23006, ' Francisco Javier Pulgar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23007001, 23007, ' La Concepcion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23007002, 23007, ' Jose Ramon Yepes');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23007003, 23007, ' Mariano Parra Leon');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23007004, 23007, ' San Jose');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23008001, 23008, ' Casigua El Cubo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23008002, 23008, ' Jesus Maria Semprun');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23008003, 23008, ' Bari');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23009001, 23009, ' Concepcion');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23009002, 23009, ' Andres Bello');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23009003, 23009, ' Chiquinquira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23009004, 23009, ' El Carmelo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23009005, 23009, ' Potreritos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23010001, 23010, ' Ciudad Ojeda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23010002, 23010, ' Alonso de Ojeda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23010003, 23010, ' Libertad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23010004, 23010, ' Campo Lara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23010005, 23010, ' Eleazar Lopez Contreras');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23010006, 23010, ' Venezuela');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23011001, 23011, ' Machiques');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23011002, 23011, ' Libertad');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23011003, 23011, ' Bartolome de Las Casas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23011004, 23011, ' Rio Negro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23011005, 23011, ' San Jose de Perija');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23012001, 23012, ' San Rafael de El Mojan');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23012002, 23012, ' San Rafael');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23012003, 23012, ' La Sierrita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23012004, 23012, ' Las Parcelas');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23012005, 23012, ' Luis de Vicente');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23012006, 23012, ' Monse&ntilde;or Marcos Sergio Godoy');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23012007, 23012, ' Ricaurte');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23012008, 23012, ' Tamare');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013001, 23013, ' Maracaibo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013002, 23013, ' Antonio Borjas Romero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013003, 23013, ' Bolivar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013004, 23013, ' Cacique Mara');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013005, 23013, ' Caracciolo Parra Perez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013006, 23013, ' Cecilio Acosta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013007, 23013, ' Cristo de Aranza');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013008, 23013, ' Coquivacoa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013009, 23013, ' Chiquinquira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013010, 23013, ' Francisco Eugenio Bustamante');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013011, 23013, ' Idelfonso Vasquez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013012, 23013, ' Juana de Avila');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013013, 23013, ' Luis Hurtado Higuera');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013014, 23013, ' Manuel Dagnino');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013015, 23013, ' Olegario Villalobos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013016, 23013, ' Raul Leoni');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013017, 23013, ' Santa Lucia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013018, 23013, ' Venancio Pulgar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23013019, 23013, ' San Isidro');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23014001, 23014, ' Los Puertos de Altagracia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23014002, 23014, ' Altagracia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23014003, 23014, ' Ana Maria Campos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23014004, 23014, ' Faria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23014005, 23014, ' San Antonio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23014006, 23014, ' San Jose');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23015001, 23015, ' Sinamaica');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23015002, 23015, ' Alta Guajira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23015003, 23015, ' Elias Sanchez Rubio');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23015004, 23015, ' Guajira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23016001, 23016, ' La Villa del Rosario');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23016002, 23016, ' El Rosario');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23016003, 23016, ' Donaldo Garcia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23016004, 23016, ' Sixto Zambrano');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23017001, 23017, ' San Francisco');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23017002, 23017, ' El Bajo');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23017003, 23017, ' Domitila Flores');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23017004, 23017, ' Francisco Ochoa');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23017005, 23017, ' Los Cortijos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23017006, 23017, ' Marcial Hernandez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23018001, 23018, ' Santa Rita');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23018002, 23018, ' El Mene');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23018003, 23018, ' Jose Cenovio Urribarri');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23018004, 23018, ' Pedro Lucas Urribarri');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23019001, 23019, ' Tia Juana');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23019002, 23019, ' Manuel Manrique');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23019003, 23019, ' Rafael Maria Baralt');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23019004, 23019, ' Rafael Urdaneta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23020001, 23020, ' Bobures');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23020002, 23020, ' El Batey');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23020003, 23020, ' Gibraltar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23020004, 23020, ' Heras');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23020005, 23020, ' Monse&ntilde;or Arturo Celestino Alvarez');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23020006, 23020, ' Romulo Gallegos');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23021001, 23021, ' Bachaquero');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23021002, 23021, ' La Victoria');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23021003, 23021, ' Rafael Urdaneta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (23021004, 23021, ' Raul Cuenca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001001, 24001, ' La Guaira');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001003, 24001, ' Carayaca');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001004, 24001, ' Caruao');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001005, 24001, ' Catia La Mar');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001006, 24001, ' El Junko');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001007, 24001, ' Macuto');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001008, 24001, ' Maiquetia');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001009, 24001, ' Naiguata');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001010, 24001, ' Raul Leoni');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001011, 24001, ' Carlos Soublette');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19005001, 19005, ' Car&uacute;pano');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (24001002, 24001, ' Caraballeda');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (19004002, 19004, ' El Rinc&oacute;n');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (15003001, 15003, ' Nuestra Se&ntilde;ora Del Rosario De Baruta');
INSERT INTO parroquia (idparroquia, idmunicipio, descripparroquia) VALUES (1001007, 1001, ' Coche');


--
-- TOC entry 2161 (class 0 OID 53078)
-- Dependencies: 1616
-- Data for Name: periodo_academico; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO periodo_academico (idperiodo, codperiodo, fechafinal, fechainicio) VALUES (2, '01-13', '2013-08-01', '2012-05-01');


--
-- TOC entry 2162 (class 0 OID 53083)
-- Dependencies: 1618
-- Data for Name: personal_sector_comunidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (1, 1, 0, 'V15784759', 'JESUS', 'PAREJO', '04157849577', 'CANTARRANA', 'SINCORREO19@GMAIL.COM', '2', 'M');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (2, 2, 0, 'V12458745', 'JUAN', 'PEREZ', '04157849546', 'SIN DIRECCION', 'SINCORREO20@GMAIL.COM', '2', 'M');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (3, 3, 0, 'V13458745', 'ARTURO', 'SUBERO', '04147854145', 'SIN DIRECCION', 'SINCORREO22@GMAIL.COM', '2', 'M');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (4, 4, 0, 'V15741854', 'MARIA', 'LOPEZ', '04167845426', 'SIN DIRECCION', 'SINCORREO23@GMAIL.COM', '2', 'F');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (7, 7, 0, 'V10451287', 'PEDRO', 'PEREZ', '04147854875', 'SIN DIRECCION', 'SINCORREO26@GMAIL.COM', '2', 'M');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (8, 8, 0, 'V15748564', 'LUISA', 'PERDOMO', '04247851425', 'SIN IDRECCION', 'SINCORREO28@GMAIL.COM', '2', 'F');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (9, 9, 0, 'V14785478', 'PEDRO', 'GAMARDO', '04164587485', 'SIN DIRECCION', 'SINCORREO29@GMAIL.COM', '2', 'M');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (6, 6, 2, 'V9451658', 'SIMON', 'GONZALEZ', '04264875965', 'SIN DIRECCION', 'SINCORREO27@GMAIL.COM', '2', 'M');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (10, 6, 0, 'V11245784', 'ARGENIS', 'FUENTES', '04164875412', 'URB. SAN LUIS, SECTOR SAN LUIS III. VEREDA 4.CASA 12', 'SINCORREO67@GMAIL.COM', '1', 'M');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (11, 6, 0, 'V10125478', 'MARIA', 'FUENTES', '02934578455', 'URB. SAN LUIS, SECTOR SAN LUIS III, VEREDA 6. CASA 54', 'SINCORREO67@GMAIL.COM', '1', 'F');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (5, 5, 3, 'V13450416', 'JUAN', 'SOTILLO', '04247845123', 'SIN DIRECCION', 'SINCORREO25@GMAIL.COM', '2', 'M');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (12, 10, 0, 'V11111111', 'RGRERGR', 'RGERGRE', '45435345345', 'GRERGEGRG', 'RRRGERG@RGRE.COM', '2', 'F');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (13, 11, 0, 'V33333333', 'GRRGRE', 'RGRREG', '34535443543', 'GRGRREGERG', 'RREREGRE@ETHEH.COM', '2', 'F');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (14, 12, 0, 'V544354', 'EFEWFEW', 'EFWEEEWFW', '32424243223', '&quot;SAN LUIS&quot;', 'ERGGRE@RTHRTH.COM', '2', 'F');
INSERT INTO personal_sector_comunidad (idpersona, idsectorcomunidad, idusuario, cedpersona, nompersona, apepersona, telefpersona, dirpersona, emailpersona, statuspersona, sexopersona) VALUES (15, 10, 0, 'V45353453', 'GERG', 'RGERGR', '34554353534', 'RGRE óN &quot;OLOO&quot;', 'WEGEWG@RGRE.COM', '1', 'F');


--
-- TOC entry 2163 (class 0 OID 53088)
-- Dependencies: 1620
-- Data for Name: pnf; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO pnf (idpnf, descripcionpnf, fechainiciopnf, abrevpnf) VALUES (1, 'INFORMATICA', '2002-04-05', 'INF');


--
-- TOC entry 2164 (class 0 OID 53093)
-- Dependencies: 1622
-- Data for Name: problema; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (11, 10, '&quot;COMILLAS&quot; ACETó TOñO', 8, '&quot;COMILLAS&quot; ACETó TOñO', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (9, 6, 'NUESTRA COMUNIDAD POSEE UN PROBLEMA MUY GRAVE CON RESPECTO AL ALUMBRADO PúBLICO, YA QUE SE ENCUENTRA MUY DETERIORADO POR EL PASAR DE LOS AñOS. LOS CABLES DE ALTA TENSIóN SE ENCUENTRAN EMPATADOS EN MUCHAS PARTES.', 9, 'PROYECTO PARA REALIZAR UN NUEVO CABLEADO EN LA COMUNIDAD', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (12, 5, 'PROBLAME DE ASFALTADO', 0, 'ASFALTO DE ALTA CALIDAD', '0');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (1, 1, 'FALTA DE UNA EMISORA', 1, 'EMISORA COMUNITARIA', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (2, 2, 'FALTA DE VIGILANCIA', 2, 'SISTEMA DE VIDEOVIGILANCIA EN TIEMPO REAL', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (3, 4, 'FALTA DE CONTROL EN LAS DONACIONES DE MEDICAMENTOS', 3, 'HERRAMIENTA PARA EL APOYO DE LAS DONACIONES DE MEDICAMENTOS Y EQUIPOS ORTOPéDICOS', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (5, 5, 'FILTRACIóN EN LOS SALONES', 0, 'COLOCAR MANTOS EN EL TECHO DE LOS SALONES QUE SE FILTRAN', '0');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (4, 5, 'FALTA DE ADMINISTRACIóN EN LA ASIGNACIóN DEL PROGRAMA PAE', 4, 'UNA HERRAMIENTA WEB PARA EL CONTROL DEL PAE', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (6, 7, 'FALTA DE APOYO EN LOS PLANES DE ESTUDIO E INVESTIGACIóN PARA LA FORMACIóN ACADéMICA EN LA COMUNIDAD ESTUDIANTIL DE CANTARRANA', 5, 'DESARROLLO DE UNA APLICACIóN WEB EN APOYO A LOS PLANES DE ESTUDIO E INVESTIGACIóN PARA LA FORMACIóN ACADéMICA EN LA COMUNIDAD ESTUDIANTIL DE CANTARRANA', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (7, 8, 'FALTA DE APOYO PARA EL MANTENIMIENTO DE LOS EQUIPOS INFORMáTICOS', 6, 'HERRAMIENTA WEB QUE APOYE A LA FALTA DE MANTENIMEINTO DE LOS EQUIPOS INFORMáTICOS DE LA COMUNIDAD DE EL PEñóN', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (8, 9, 'FALTA DE CONTROL EN LA PRODUCCIóN PESQUERA EN EL CONSEJO DE PESCADORES DE EL PEñóN, ESTADO SUCRE', 7, 'DISEñO DE UNA HERRAMIENTA WEB PARA EL CONTROL DE LA PRODUCCIóN PESQUERA DEL CONSEJO DE PESCADORES DE EL PEñóN, ESTADO SUCRE', '1');
INSERT INTO problema (idproblema, idsectorcomunidad, descripcionproblema, iddiagnostico, posiblesolucion, seleccionado) VALUES (10, 10, '&quot;COMILLAS&quot; ACETúA', 0, 'CERRó &quot;COMILLAS&quot;', '0');


--
-- TOC entry 2165 (class 0 OID 53101)
-- Dependencies: 1624
-- Data for Name: proyecto; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO proyecto (idproyecto, idgrupo, idantep, idjefe, iddocente, idpnf, doc_iddocente, idpersona, idproblema, iddiagnostico, idperiodo, codproy, nomproyecto, objproyecto, areaconocimi, trimestreproy, trayectoproy, fechaproy, observproy, statusproy) VALUES (6, 1, 5, 1, 10, 1, 10, 1, 1, 1, 2, 'INFPROTIV00001', 'RADIO COMUNITARIA CANTARRANA: ESPACIO DE INTEGRACIóN COMUNITARIA CIMENTADO EN LAS TECNOLOGíAS DE INFORMACIóN Y COMUNICACIóN EN LA COMUNIDAD DE CANTARRANA SECTOR SAN JOSé DE CAMINO NUEVO, PARROQUIA SANTA INéS, MUNICIPIO SUCRE, ESTADO SUCRE 2012', 'CREACIÓN D EUNA RADIO COMUNITARIA BAJO AMBIENTE WEB', 'WEB', '3', '4', '2013-05-04', 'SIN OBSERVACIONES...', 'EVALUADO');
INSERT INTO proyecto (idproyecto, idgrupo, idantep, idjefe, iddocente, idpnf, doc_iddocente, idpersona, idproblema, iddiagnostico, idperiodo, codproy, nomproyecto, objproyecto, areaconocimi, trimestreproy, trayectoproy, fechaproy, observproy, statusproy) VALUES (8, 2, 6, 1, 10, 1, 1, 2, 2, 2, 2, 'INFPROTIV00008', 'SEGURIDAD COMUNITARIA: INCORPORACIóN DE LAS TIC A TRAVéS DE UN SERVICIO DE VIDEOVIGILANCIA COMUNITARIA EN LA COMUNIDAD DE CASCAJAL VIEJO', 'CREACIÓN DE SISTEMA DE VIDEOVIGILANCIA', 'WEB', '3', '4', '2013-05-05', 'SIN OBSERVACIONES...', 'INICIADO');
INSERT INTO proyecto (idproyecto, idgrupo, idantep, idjefe, iddocente, idpnf, doc_iddocente, idpersona, idproblema, iddiagnostico, idperiodo, codproy, nomproyecto, objproyecto, areaconocimi, trimestreproy, trayectoproy, fechaproy, observproy, statusproy) VALUES (7, 3, 4, 1, 4, 1, 4, 4, 3, 3, 2, 'INFPROTIV00007', 'ADMINISTRACIóN DE LAS DONACIONES DE MEDICAMENTOS Y EQUIPOS ORTOPéDICOS EN LA COMUNIDAD DE CAIGUIRE SECTOR CAMPO ALEGRE I CUMANA EDO-SUCRE', 'HERRAMIENTA PARA EL CONTROL DE LAS DONACIONES DE MEDICAMENTOS Y EQUIPOS ORTOPéDICOS EN LA COMUNIDAD DE CAIGUIRE SECTOR CAMPO ALEGRE I CUMANA EDO-SUCRE', 'WEB', '3', '4', '2013-05-04', 'SIN OBSERVACIONES...', 'INICIADO');
INSERT INTO proyecto (idproyecto, idgrupo, idantep, idjefe, iddocente, idpnf, doc_iddocente, idpersona, idproblema, iddiagnostico, idperiodo, codproy, nomproyecto, objproyecto, areaconocimi, trimestreproy, trayectoproy, fechaproy, observproy, statusproy) VALUES (10, 9, 16, 1, 11, 1, 11, 6, 9, 9, 2, 'INFPROTIV000010', 'TITULO ANTEPROYECTO', 'OBJETIVO GENERAL', 'WEB', '2', '4', '2013-05-10', 'SIN OBSERVACIONES...', 'EVALUADO');
INSERT INTO proyecto (idproyecto, idgrupo, idantep, idjefe, iddocente, idpnf, doc_iddocente, idpersona, idproblema, iddiagnostico, idperiodo, codproy, nomproyecto, objproyecto, areaconocimi, trimestreproy, trayectoproy, fechaproy, observproy, statusproy) VALUES (9, 8, 15, 1, 2, 1, 2, 12, 11, 8, 2, 'INFPROTIII00009', 'ACENTÓ LOÑO &quot;COMI&quot;', 'ACENTÓ LOÑO &quot;COMI&quot;', 'ACENTÓ LOÑO &quot;COMI&quot;', '3', '3', '2013-05-07', 'ACENTÓ LOÑO &quot;COMI&quot;', 'EVALUADO');


--
-- TOC entry 2166 (class 0 OID 53109)
-- Dependencies: 1626
-- Data for Name: sector_comunidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (1, 2, 'SAN JOSE', 'SAN JOSE');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (2, 3, 'CASCAJAL VIEJO', 'CERCA DE BRASIL');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (3, 4, 'CAIGUIRE', 'CERCA DEL AMBULATORIO SALVADOR ALLENDE');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (4, 5, 'CAMPO ALEGRE I', 'CERCA DEL CDI');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (5, 6, 'PUERTO ESPAñA', 'CERCA DE LA CANCHA');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (6, 7, 'SAN LUIS III', 'CERCA DE LA REDOMA');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (7, 8, 'CERRO SABINO', 'DETRAS DE LA UPTOS');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (8, 9, 'EL PEñON I', 'CERCA DE LA FERRETERIA');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (9, 10, 'EL PEñON', 'CERCA DE LA PLAYA');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (10, 11, 'OOOOOO', 'OOOOOO');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (11, 12, 'EREH', 'RGRGE');
INSERT INTO sector_comunidad (idsectorcomunidad, idcomuni, descripsector, dirsector) VALUES (12, 13, '&quot;SAN KLUIS&quot;', '&quot;SAN LUIS&quot; .');


--
-- TOC entry 2167 (class 0 OID 53114)
-- Dependencies: 1628
-- Data for Name: seguridad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (2, 1, 'ENTRADA AL SISTEMA', '2013-05-03 18:46:32');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (3, 1, 'REGISTRO DE PERIODO CON CODIGO: 01-13', '2013-05-03 18:47:32');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (4, 1, 'REGISTRO DE DOCENTE CON CEDULA: V12567525', '2013-05-03 18:54:30');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (5, 1, 'REGISTRO DE DOCENTE CON CEDULA: V10460671', '2013-05-03 18:57:27');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (6, 1, 'REGISTRO DE DOCENTE CON CEDULA: V13631637', '2013-05-03 19:01:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (7, 1, 'REGISTRO DE DOCENTE CON CEDULA: V13222280', '2013-05-03 19:03:12');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (8, 1, 'REGISTRO DE DOCENTE CON CEDULA: V11382708', '2013-05-03 19:05:52');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (9, 1, 'REGISTRO DE DOCENTE CON CEDULA: V12665033', '2013-05-03 19:55:31');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (10, 1, 'REGISTRO DE DOCENTE CON CEDULA: V13053555', '2013-05-03 19:57:57');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (11, 1, 'REGISTRO DE DOCENTE CON CEDULA: V11378327', '2013-05-03 19:59:47');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (12, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V17445805', '2013-05-03 20:01:18');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (13, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V17539586', '2013-05-03 20:02:01');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (14, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16484128', '2013-05-03 20:02:39');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (15, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V17445009', '2013-05-03 20:03:15');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (16, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16338682', '2013-05-03 20:03:52');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (17, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16817781', '2013-05-03 20:04:32');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (18, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16314821', '2013-05-03 20:19:43');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (19, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15249486', '2013-05-03 20:20:58');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (20, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V5086719', '2013-05-03 20:21:42');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (21, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16995504', '2013-05-03 20:23:04');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (22, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15740964', '2013-05-03 20:23:59');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (23, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V17213040', '2013-05-03 20:24:34');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (24, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16701874', '2013-05-03 20:25:05');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (25, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V18418185', '2013-05-03 20:25:45');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (26, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V18212940', '2013-05-03 20:26:31');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (27, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V17212861', '2013-05-03 20:27:09');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (28, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15934877', '2013-05-03 20:27:42');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (29, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15740816', '2013-05-03 20:28:13');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (30, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16818597', '2013-05-03 20:28:55');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (31, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16818648', '2013-05-03 20:29:25');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (32, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16313275', '2013-05-03 20:30:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (33, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15289129', '2013-05-03 20:30:43');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (34, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15936060', '2013-05-03 20:31:15');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (35, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16817559', '2013-05-03 20:31:50');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (36, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15741078', '2013-05-03 20:32:18');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (37, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 2', '2013-05-03 20:52:53');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (38, 1, 'REGISTRO DE SECTOR CON CODIGO: 1', '2013-05-03 20:52:53');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (39, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V15784759', '2013-05-03 20:52:53');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (40, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 3', '2013-05-03 20:55:42');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (41, 1, 'REGISTRO DE SECTOR CON CODIGO: 2', '2013-05-03 20:55:42');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (42, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V12458745', '2013-05-03 20:55:42');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (43, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 4', '2013-05-03 20:57:24');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (44, 1, 'REGISTRO DE SECTOR CON CODIGO: 3', '2013-05-03 20:57:24');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (45, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V13458745', '2013-05-03 20:57:24');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (46, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 5', '2013-05-03 20:59:48');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (47, 1, 'REGISTRO DE SECTOR CON CODIGO: 4', '2013-05-03 20:59:48');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (48, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V15741854', '2013-05-03 20:59:48');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (49, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 6', '2013-05-03 21:02:54');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (50, 1, 'REGISTRO DE SECTOR CON CODIGO: 5', '2013-05-03 21:02:54');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (51, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V13450416', '2013-05-03 21:02:54');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (52, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 7', '2013-05-03 21:04:18');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (53, 1, 'REGISTRO DE SECTOR CON CODIGO: 6', '2013-05-03 21:04:18');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (54, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V9451658', '2013-05-03 21:04:18');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (55, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 8', '2013-05-03 21:05:44');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (56, 1, 'REGISTRO DE SECTOR CON CODIGO: 7', '2013-05-03 21:05:44');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (57, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V10451287', '2013-05-03 21:05:44');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (58, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 9', '2013-05-03 21:07:19');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (59, 1, 'REGISTRO DE SECTOR CON CODIGO: 8', '2013-05-03 21:07:19');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (60, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V15748564', '2013-05-03 21:07:19');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (61, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 10', '2013-05-03 21:08:45');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (62, 1, 'REGISTRO DE SECTOR CON CODIGO: 9', '2013-05-03 21:08:45');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (63, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V14785478', '2013-05-03 21:08:45');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (64, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J111111111', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (65, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J222222222', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (66, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J333333333', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (67, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J444444444', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (68, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J555555555', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (69, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J666666666', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (70, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J777777777', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (71, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J888888888', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (72, 1, 'REGISTRO DE CONSEJO COMUNAL CON R.I.F.: J999999999', '2013-05-01 00:00:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (73, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16172520', '2013-05-03 21:31:59');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (74, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15110637', '2013-05-03 21:32:37');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (75, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15934802', '2013-05-03 21:33:12');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (76, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16702891', '2013-05-03 21:34:47');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (77, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V14124565', '2013-05-03 21:35:20');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (78, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V14008427', '2013-05-03 21:36:31');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (79, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V15935505', '2013-05-03 21:37:05');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (80, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V14815393', '2013-05-03 21:38:37');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (81, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16486762', '2013-05-03 21:39:12');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (82, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V14661396', '2013-05-03 21:43:29');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (83, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 1 PARA EL SECTOR: 1', '2013-05-03 22:07:35');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (84, 1, 'REGISTRO DE DOCENTE CON CEDULA: V11826847', '2013-05-03 22:24:55');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (85, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-03 22:25:21');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (86, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-03 23:27:01');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (87, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-03 23:31:22');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (88, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-03 23:38:22');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (89, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-03 23:40:48');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (90, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-04 08:51:56');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (91, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-04 09:16:26');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (92, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-04 09:24:51');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (93, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 1', '2013-05-04 09:29:08');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (94, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 2 PARA EL SECTOR: 2', '2013-05-04 09:34:13');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (95, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 2', '2013-05-04 09:34:33');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (96, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 3 PARA EL SECTOR: 4', '2013-05-04 09:39:25');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (97, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 3', '2013-05-04 09:39:43');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (98, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-04 10:24:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (99, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-04 10:58:22');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (100, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-04 11:00:05');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (101, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-04 11:01:16');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (102, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-04 11:02:31');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (103, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-04 11:24:30');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (104, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V18211259', '2013-05-04 11:29:46');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (105, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-04 12:14:21');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (106, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-04 12:18:39');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (107, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-04 12:19:20');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (108, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-04 12:20:43');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (109, 1, 'REGISTRO DE EVALUACION NRO: 1', '2013-05-04 12:32:39');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (110, 1, 'REGISTRO DE EVALUACION NRO: 1', '2013-05-04 12:42:27');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (111, 1, 'REGISTRO DE EVALUACION NRO: 1', '2013-05-04 13:05:52');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (112, 1, 'REGISTRO DE EVALUACION NRO: 1', '2013-05-04 13:15:01');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (113, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-04 13:17:33');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (114, 1, 'ENTRADA AL SISTEMA', '2013-05-04 19:46:09');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (115, 1, 'REPORTE DEL PROYECTO: 7', '2013-05-04 20:41:02');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (116, 1, 'REPORTE DEL PROYECTO: 7', '2013-05-05 09:19:25');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (117, 1, 'REGISTRO DE USUARIO, CON LOGIN: sanluis', '2013-05-05 10:40:06');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (118, 2, 'ENTRADA AL SISTEMA', '2013-05-05 10:40:48');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (119, 1, 'ENTRADA AL SISTEMA', '2013-05-05 10:44:33');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (120, 1, 'REGISTRO DE PERSONAL COMUNIDAD: 10', '2013-05-05 10:46:04');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (121, 1, 'REGISTRO DE PERSONAL COMUNIDAD: 11', '2013-05-05 10:48:37');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (122, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 4 PARA EL SECTOR: 5', '2013-05-05 10:55:08');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (123, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 5 PARA EL SECTOR: 5', '2013-05-05 10:55:40');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (124, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 4', '2013-05-05 10:56:51');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (125, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 6 PARA EL SECTOR: 7', '2013-05-05 11:02:57');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (126, 1, 'REGISTRO DE DOCENTE CON CEDULA: V13731079', '2013-05-05 11:05:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (127, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 5', '2013-05-05 11:05:25');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (128, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 7 PARA EL SECTOR: 8', '2013-05-05 11:09:08');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (129, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 6', '2013-05-05 11:09:25');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (130, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 8 PARA EL SECTOR: 9', '2013-05-05 11:16:58');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (131, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 7', '2013-05-05 11:18:49');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (132, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V16818049', '2013-05-05 11:26:19');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (133, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V17911619', '2013-05-05 11:27:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (134, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V17909215', '2013-05-05 11:34:21');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (135, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-05 11:37:25');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (136, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-05 11:42:11');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (137, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-05 11:50:42');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (138, 1, 'ENTRADA AL SISTEMA', '2013-05-05 11:58:38');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (139, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-05 19:32:36');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (140, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-05 21:32:48');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (141, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-05 21:38:49');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (142, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-05 21:40:26');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (143, 1, 'REPORTE DEL PROYECTO: 7', '2013-05-05 21:44:17');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (144, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-05 21:45:11');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (145, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-05 21:48:26');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (146, 1, 'REPORTE DEL PROYECTO: 7', '2013-05-05 21:49:13');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (147, 2, 'ENTRADA AL SISTEMA', '2013-05-05 22:45:54');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (148, 1, 'ENTRADA AL SISTEMA', '2013-05-05 22:46:39');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (149, 1, 'REGISTRO DE USUARIO, CON LOGIN: puertoespana', '2013-05-05 22:48:49');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (150, 3, 'ENTRADA AL SISTEMA', '2013-05-05 22:49:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (151, 1, 'ENTRADA AL SISTEMA', '2013-05-05 22:49:36');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (152, 3, 'ENTRADA AL SISTEMA', '2013-05-05 22:50:03');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (153, 3, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-05 22:50:50');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (154, 1, 'ENTRADA AL SISTEMA', '2013-05-05 22:51:08');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (155, 3, 'ENTRADA AL SISTEMA', '2013-05-05 22:57:06');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (156, 1, 'ENTRADA AL SISTEMA', '2013-05-05 23:10:51');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (157, 1, 'ENTRADA AL SISTEMA', '2013-05-05 23:11:52');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (158, 1, 'ENTRADA AL SISTEMA', '2013-05-06 12:27:33');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (159, 1, 'ENTRADA AL SISTEMA', '2013-05-06 13:18:54');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (160, 1, 'ENTRADA AL SISTEMA', '2013-05-06 15:53:04');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (161, 1, 'ENTRADA AL SISTEMA', '2013-05-06 16:44:39');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (162, 2, 'ENTRADA AL SISTEMA', '2013-05-06 16:45:10');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (163, 2, 'REGISTRO DE PROBLEMA CON CODIGO: 9 PARA EL SECTOR: 6', '2013-05-06 16:47:07');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (164, 1, 'ENTRADA AL SISTEMA', '2013-05-06 17:01:43');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (165, 1, 'ENTRADA AL SISTEMA', '2013-05-06 17:58:56');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (166, 1, 'ENTRADA AL SISTEMA', '2013-05-07 10:54:22');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (167, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 11', '2013-05-07 12:21:06');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (168, 1, 'REGISTRO DE SECTOR CON CODIGO: 10', '2013-05-07 12:21:06');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (169, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V11111111', '2013-05-07 12:21:06');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (170, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 12', '2013-05-07 12:46:23');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (171, 1, 'REGISTRO DE SECTOR CON CODIGO: 11', '2013-05-07 12:46:23');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (172, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V33333333', '2013-05-07 12:46:23');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (173, 1, 'REGISTRO DE DOCENTE CON CEDULA: V54646456', '2013-05-07 13:57:16');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (174, 1, 'ELIMINACION DE DOCENTE CON ID: 12', '2013-05-07 13:57:44');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (175, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V56646566', '2013-05-07 14:00:20');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (176, 1, 'REGISTRO DE COMUNIDAD CON CODIGO: 13', '2013-05-07 14:03:01');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (177, 1, 'REGISTRO DE SECTOR CON CODIGO: 12', '2013-05-07 14:03:01');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (178, 1, 'REGISTRO DE RESPONSABLE DE COMUNIDAD CON CEDULA: V544354', '2013-05-07 14:03:01');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (179, 1, 'REGISTRO DE PERSONAL COMUNIDAD: 15', '2013-05-07 14:26:32');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (180, 1, 'REGISTRO DE ESTUDIANTE CON CEDULA: V44353453', '2013-05-07 14:28:26');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (181, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 10 PARA EL SECTOR: 10', '2013-05-07 14:30:01');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (182, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 14:30:33');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (183, 1, 'REGISTRO DE PROBLEMA CON CODIGO: 11 PARA EL SECTOR: 10', '2013-05-07 14:35:34');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (184, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 14:35:55');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (185, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 14:40:30');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (186, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 14:43:03');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (187, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 14:44:53');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (188, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 14:51:33');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (189, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 14:56:28');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (190, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 15:15:12');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (191, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 8', '2013-05-07 15:22:07');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (192, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-07 15:26:22');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (193, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-07 15:29:41');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (194, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-07 15:31:43');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (195, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-07 15:33:24');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (196, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-07 15:37:13');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (197, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-07 15:38:29');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (198, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-07 15:40:06');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (199, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-07 15:43:00');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (200, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-07 15:46:56');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (201, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-07 15:49:29');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (202, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-07 15:54:15');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (203, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-07 15:57:11');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (204, 2, 'ENTRADA AL SISTEMA', '2013-05-07 16:11:29');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (205, 1, 'ENTRADA AL SISTEMA', '2013-05-07 16:11:39');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (206, 1, 'ENTRADA AL SISTEMA', '2013-05-07 20:46:45');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (207, 1, 'ENTRADA AL SISTEMA', '2013-05-07 20:47:26');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (208, 1, 'ENTRADA AL SISTEMA', '2013-05-07 20:54:39');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (209, 1, 'REPORTE DEL DIAGNOSTICO: 7', '2013-05-07 22:11:28');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (210, 1, 'ENTRADA AL SISTEMA', '2013-05-08 16:37:59');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (211, 1, 'ENTRADA AL SISTEMA', '2013-05-09 10:30:13');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (212, 1, 'ENTRADA AL SISTEMA', '2013-05-09 21:51:26');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (213, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-09 23:47:41');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (214, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-09 23:55:54');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (215, 1, 'REGISTRO DE EVALUACION NRO: 3', '2013-05-09 23:56:13');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (216, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:00:04');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (217, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:16:09');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (218, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:17:56');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (219, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:20:44');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (220, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:22:57');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (221, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:25:09');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (222, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:33:13');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (223, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:37:14');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (224, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:38:25');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (225, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:39:51');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (226, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:42:08');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (227, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 00:56:42');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (228, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-10 01:16:54');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (229, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-10 01:30:52');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (230, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-10 01:44:21');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (231, 1, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-10 01:45:46');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (232, 1, 'ENTRADA AL SISTEMA', '2013-05-10 01:46:34');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (233, 1, 'ENTRADA AL SISTEMA', '2013-05-10 02:27:59');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (234, 1, 'ENTRADA AL SISTEMA', '2013-05-10 22:09:57');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (235, 1, 'REGISTRO DE DIAGNOSTICO CON CODIGO: 9', '2013-05-10 22:13:27');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (236, 1, 'REGISTRO DE ANTEPROYECTO CON CODIGO: ', '2013-05-10 22:17:10');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (237, 1, 'REGISTRO DE PROYECTO CON CODIGO: ', '2013-05-10 22:18:30');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (238, 1, 'REGISTRO DE EVALUACION NRO: 2', '2013-05-10 22:21:03');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (239, 3, 'ENTRADA AL SISTEMA', '2013-05-10 22:24:03');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (240, 3, 'REGISTRO DE PROBLEMA CON CODIGO: 12 PARA EL SECTOR: 5', '2013-05-10 22:25:02');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (241, 3, 'REPORTE DEL ANTEPROYECTO: 8', '2013-05-10 22:26:10');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (242, 1, 'ENTRADA AL SISTEMA', '2013-05-10 22:26:41');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (243, 1, 'ENTRADA AL SISTEMA', '2013-05-13 11:57:18');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (244, 1, 'ENTRADA AL SISTEMA', '2013-05-13 12:21:45');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (245, 1, 'ENTRADA AL SISTEMA', '2013-05-14 20:57:38');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (246, 1, 'ENTRADA AL SISTEMA', '2013-06-26 19:00:41');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (247, 1, 'REGISTRO DE EVALUACION NRO: 3', '2013-06-26 20:20:09');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (248, 1, 'REGISTRO DE EVALUACION NRO: 3', '2013-06-26 20:25:18');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (249, 1, 'REGISTRO DE EVALUACION NRO: 3', '2013-06-26 20:27:44');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (250, 1, 'REGISTRO DE EVALUACION NRO: 3', '2013-06-26 20:34:12');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (251, 1, 'REGISTRO DE EVALUACION NRO: 3', '2013-06-26 20:36:45');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (252, 1, 'REGISTRO DE EVALUACION NRO: 3', '2013-06-26 20:45:45');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (253, 1, 'ENTRADA AL SISTEMA', '2013-06-28 17:46:21');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (254, 1, 'ENTRADA AL SISTEMA', '2013-06-28 18:10:06');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (255, 1, 'ENTRADA AL SISTEMA', '2013-06-28 18:11:23');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (256, 1, 'ENTRADA AL SISTEMA', '2013-06-28 18:28:08');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (257, 1, 'REGISTRO DE DOCENTE CON CEDULA: V45555555', '2013-06-28 20:44:26');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (258, 1, 'ENTRADA AL SISTEMA', '2013-06-29 21:20:35');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (259, 1, 'MODIFICACION DE DOCENTE CON CEDULA: V13942458', '2013-06-29 22:08:49');
INSERT INTO seguridad (idseguridad, idusuario, accionrealizada, fechaaccion) VALUES (260, 1, 'MODIFICACION DE DOCENTE CON CEDULA: V10460671', '2013-06-29 22:10:50');


--
-- TOC entry 2168 (class 0 OID 53122)
-- Dependencies: 1630
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuario (idusuario, clave, login, fecharegistro, perfilusuario) VALUES (0, '', '', '2011-11-24', '');
INSERT INTO usuario (idusuario, clave, login, fecharegistro, perfilusuario) VALUES (1, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'JRODRIGUEZ', '2013-05-03', '1');
INSERT INTO usuario (idusuario, clave, login, fecharegistro, perfilusuario) VALUES (2, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'SANLUIS', '2013-05-05', '3');
INSERT INTO usuario (idusuario, clave, login, fecharegistro, perfilusuario) VALUES (3, '7c4a8d09ca3762af61e59520943dc26494f8941b', 'PUERTOESPANA', '2013-05-05', '3');


--
-- TOC entry 1943 (class 2606 OID 53154)
-- Dependencies: 1579 1579
-- Name: pk_anteproyecto; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT pk_anteproyecto PRIMARY KEY (idantep);


--
-- TOC entry 1954 (class 2606 OID 53156)
-- Dependencies: 1581 1581
-- Name: pk_comision_tecnica; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comision_tecnica
    ADD CONSTRAINT pk_comision_tecnica PRIMARY KEY (idcomision);


--
-- TOC entry 1957 (class 2606 OID 53158)
-- Dependencies: 1583 1583
-- Name: pk_comunidad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY comunidad
    ADD CONSTRAINT pk_comunidad PRIMARY KEY (idcomuni);


--
-- TOC entry 2080 (class 2606 OID 53597)
-- Dependencies: 1633 1633
-- Name: pk_consejo_comunal; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY consejo_comunal
    ADD CONSTRAINT pk_consejo_comunal PRIMARY KEY (idconsejo);


--
-- TOC entry 1961 (class 2606 OID 53160)
-- Dependencies: 1585 1585
-- Name: pk_denuncia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY denuncia
    ADD CONSTRAINT pk_denuncia PRIMARY KEY (iddenuncia);


--
-- TOC entry 1968 (class 2606 OID 53162)
-- Dependencies: 1587 1587
-- Name: pk_diagnostico; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT pk_diagnostico PRIMARY KEY (iddiagnostico);


--
-- TOC entry 1978 (class 2606 OID 53164)
-- Dependencies: 1589 1589
-- Name: pk_docente; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY docente
    ADD CONSTRAINT pk_docente PRIMARY KEY (iddocente);


--
-- TOC entry 1982 (class 2606 OID 53166)
-- Dependencies: 1591 1591
-- Name: pk_entdiag; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY entdiag
    ADD CONSTRAINT pk_entdiag PRIMARY KEY (identdiag);


--
-- TOC entry 1986 (class 2606 OID 53168)
-- Dependencies: 1593 1593
-- Name: pk_entproy; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY entproy
    ADD CONSTRAINT pk_entproy PRIMARY KEY (identproy);


--
-- TOC entry 1990 (class 2606 OID 53170)
-- Dependencies: 1595 1595
-- Name: pk_entreanteproy; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY entreanteproy
    ADD CONSTRAINT pk_entreanteproy PRIMARY KEY (identreanteproy);


--
-- TOC entry 1994 (class 2606 OID 53172)
-- Dependencies: 1597 1597
-- Name: pk_entregables; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY entregables
    ADD CONSTRAINT pk_entregables PRIMARY KEY (identregable);


--
-- TOC entry 1997 (class 2606 OID 53174)
-- Dependencies: 1599 1599
-- Name: pk_estado; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT pk_estado PRIMARY KEY (idestado);


--
-- TOC entry 2003 (class 2606 OID 53176)
-- Dependencies: 1601 1601
-- Name: pk_estudiante; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT pk_estudiante PRIMARY KEY (idestudiante);


--
-- TOC entry 2007 (class 2606 OID 53178)
-- Dependencies: 1603 1603 1603
-- Name: pk_evalentre; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evalentre
    ADD CONSTRAINT pk_evalentre PRIMARY KEY (idevaluacion, identregable);


--
-- TOC entry 2013 (class 2606 OID 53180)
-- Dependencies: 1604 1604
-- Name: pk_evaluacion_proyecto; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evaluacion_proyecto
    ADD CONSTRAINT pk_evaluacion_proyecto PRIMARY KEY (idevaluacion);


--
-- TOC entry 2020 (class 2606 OID 53182)
-- Dependencies: 1606 1606
-- Name: pk_grupo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grupo
    ADD CONSTRAINT pk_grupo PRIMARY KEY (idgrupo);


--
-- TOC entry 2025 (class 2606 OID 53184)
-- Dependencies: 1608 1608
-- Name: pk_jefe_pnf; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY jefe_pnf
    ADD CONSTRAINT pk_jefe_pnf PRIMARY KEY (idjefe);


--
-- TOC entry 2029 (class 2606 OID 53186)
-- Dependencies: 1610 1610
-- Name: pk_municipio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT pk_municipio PRIMARY KEY (idmunicipio);


--
-- TOC entry 2033 (class 2606 OID 53188)
-- Dependencies: 1612 1612
-- Name: pk_noticia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY noticia
    ADD CONSTRAINT pk_noticia PRIMARY KEY (idnoticia);


--
-- TOC entry 2037 (class 2606 OID 53190)
-- Dependencies: 1614 1614
-- Name: pk_parroquia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY parroquia
    ADD CONSTRAINT pk_parroquia PRIMARY KEY (idparroquia);


--
-- TOC entry 2041 (class 2606 OID 53192)
-- Dependencies: 1616 1616
-- Name: pk_periodo_academico; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY periodo_academico
    ADD CONSTRAINT pk_periodo_academico PRIMARY KEY (idperiodo);


--
-- TOC entry 2044 (class 2606 OID 53194)
-- Dependencies: 1618 1618
-- Name: pk_personal_sector_comunidad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY personal_sector_comunidad
    ADD CONSTRAINT pk_personal_sector_comunidad PRIMARY KEY (idpersona);


--
-- TOC entry 2048 (class 2606 OID 53196)
-- Dependencies: 1620 1620
-- Name: pk_pnf; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pnf
    ADD CONSTRAINT pk_pnf PRIMARY KEY (idpnf);


--
-- TOC entry 2051 (class 2606 OID 53198)
-- Dependencies: 1622 1622
-- Name: pk_problema; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY problema
    ADD CONSTRAINT pk_problema PRIMARY KEY (idproblema);


--
-- TOC entry 2060 (class 2606 OID 53200)
-- Dependencies: 1624 1624
-- Name: pk_proyecto; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT pk_proyecto PRIMARY KEY (idproyecto);


--
-- TOC entry 2068 (class 2606 OID 53202)
-- Dependencies: 1626 1626
-- Name: pk_sector_comunidad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sector_comunidad
    ADD CONSTRAINT pk_sector_comunidad PRIMARY KEY (idsectorcomunidad);


--
-- TOC entry 2072 (class 2606 OID 53204)
-- Dependencies: 1628 1628
-- Name: pk_seguridad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY seguridad
    ADD CONSTRAINT pk_seguridad PRIMARY KEY (idseguridad);


--
-- TOC entry 2076 (class 2606 OID 53206)
-- Dependencies: 1630 1630
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (idusuario);


--
-- TOC entry 1974 (class 1259 OID 53207)
-- Dependencies: 1589
-- Name: adscrito_a_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX adscrito_a_fk ON docente USING btree (idpnf);


--
-- TOC entry 1938 (class 1259 OID 53208)
-- Dependencies: 1579
-- Name: anteproyecto_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX anteproyecto_pk ON anteproyecto USING btree (idantep);


--
-- TOC entry 1950 (class 1259 OID 53209)
-- Dependencies: 1581
-- Name: comision_tecnica_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX comision_tecnica_pk ON comision_tecnica USING btree (idcomision);


--
-- TOC entry 1955 (class 1259 OID 53210)
-- Dependencies: 1583
-- Name: comunidad_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX comunidad_pk ON comunidad USING btree (idcomuni);


--
-- TOC entry 2054 (class 1259 OID 53211)
-- Dependencies: 1624
-- Name: con_lleva_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX con_lleva_fk ON proyecto USING btree (idantep);


--
-- TOC entry 2078 (class 1259 OID 53598)
-- Dependencies: 1633
-- Name: consejo_comunal_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX consejo_comunal_pk ON consejo_comunal USING btree (idconsejo);


--
-- TOC entry 1939 (class 1259 OID 53212)
-- Dependencies: 1579
-- Name: corresponde2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX corresponde2_fk ON anteproyecto USING btree (iddiagnostico);


--
-- TOC entry 1963 (class 1259 OID 53213)
-- Dependencies: 1587
-- Name: corresponde_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX corresponde_fk ON diagnostico USING btree (idsectorcomunidad);


--
-- TOC entry 1959 (class 1259 OID 53214)
-- Dependencies: 1585
-- Name: denuncia_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX denuncia_pk ON denuncia USING btree (iddenuncia);


--
-- TOC entry 1964 (class 1259 OID 53215)
-- Dependencies: 1587
-- Name: diagnostico_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX diagnostico_pk ON diagnostico USING btree (iddiagnostico);


--
-- TOC entry 1975 (class 1259 OID 53216)
-- Dependencies: 1589
-- Name: docente_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX docente_pk ON docente USING btree (iddocente);


--
-- TOC entry 2055 (class 1259 OID 53217)
-- Dependencies: 1624
-- Name: ejecutan_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ejecutan_fk ON proyecto USING btree (idgrupo);


--
-- TOC entry 2021 (class 1259 OID 53218)
-- Dependencies: 1608
-- Name: ejerce_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ejerce_fk ON jefe_pnf USING btree (iddocente);


--
-- TOC entry 1980 (class 1259 OID 53219)
-- Dependencies: 1591
-- Name: entdiag_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX entdiag_pk ON entdiag USING btree (identdiag);


--
-- TOC entry 1984 (class 1259 OID 53220)
-- Dependencies: 1593
-- Name: entproy_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX entproy_pk ON entproy USING btree (identproy);


--
-- TOC entry 1988 (class 1259 OID 53221)
-- Dependencies: 1595
-- Name: entreanteproy_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX entreanteproy_pk ON entreanteproy USING btree (identreanteproy);


--
-- TOC entry 1965 (class 1259 OID 53222)
-- Dependencies: 1587
-- Name: entrega_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX entrega_fk ON diagnostico USING btree (idgrupo);


--
-- TOC entry 1992 (class 1259 OID 53223)
-- Dependencies: 1597
-- Name: entregables_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX entregables_pk ON entregables USING btree (identregable);


--
-- TOC entry 1995 (class 1259 OID 53224)
-- Dependencies: 1599
-- Name: estado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX estado_pk ON estado USING btree (idestado);


--
-- TOC entry 1998 (class 1259 OID 53225)
-- Dependencies: 1601
-- Name: estudiante_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX estudiante_pk ON estudiante USING btree (idestudiante);


--
-- TOC entry 2005 (class 1259 OID 53226)
-- Dependencies: 1603 1603
-- Name: evalentre_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX evalentre_pk ON evalentre USING btree (idevaluacion, identregable);


--
-- TOC entry 2008 (class 1259 OID 53227)
-- Dependencies: 1604
-- Name: evalua_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX evalua_fk ON evaluacion_proyecto USING btree (idgrupo);


--
-- TOC entry 2009 (class 1259 OID 53228)
-- Dependencies: 1604
-- Name: evaluacion_proyecto_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX evaluacion_proyecto_pk ON evaluacion_proyecto USING btree (idevaluacion);


--
-- TOC entry 1940 (class 1259 OID 53229)
-- Dependencies: 1579
-- Name: facilita_a_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX facilita_a_fk ON anteproyecto USING btree (iddocente);


--
-- TOC entry 1966 (class 1259 OID 53230)
-- Dependencies: 1587
-- Name: facilita_d_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX facilita_d_fk ON diagnostico USING btree (iddocente);


--
-- TOC entry 2010 (class 1259 OID 53231)
-- Dependencies: 1604
-- Name: facilita_psc_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX facilita_psc_fk ON evaluacion_proyecto USING btree (per_idpersona);


--
-- TOC entry 2011 (class 1259 OID 53232)
-- Dependencies: 1604
-- Name: facilitada_ep_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX facilitada_ep_fk ON evaluacion_proyecto USING btree (iddocente);


--
-- TOC entry 2056 (class 1259 OID 53233)
-- Dependencies: 1624
-- Name: facilitada_p_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX facilitada_p_fk ON proyecto USING btree (doc_iddocente);


--
-- TOC entry 1941 (class 1259 OID 53234)
-- Dependencies: 1579
-- Name: figura2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX figura2_fk ON anteproyecto USING btree (idpersona);


--
-- TOC entry 2057 (class 1259 OID 53235)
-- Dependencies: 1624
-- Name: figura_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX figura_fk ON proyecto USING btree (idpersona);


--
-- TOC entry 2018 (class 1259 OID 53236)
-- Dependencies: 1606
-- Name: grupo_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX grupo_pk ON grupo USING btree (idgrupo);


--
-- TOC entry 1999 (class 1259 OID 53237)
-- Dependencies: 1601
-- Name: grupoestu_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX grupoestu_fk ON estudiante USING btree (idgrupo);


--
-- TOC entry 2000 (class 1259 OID 53238)
-- Dependencies: 1601
-- Name: habita_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX habita_fk ON estudiante USING btree (idcomuni);


--
-- TOC entry 1976 (class 1259 OID 53239)
-- Dependencies: 1589
-- Name: habitan_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX habitan_fk ON docente USING btree (idcomuni);


--
-- TOC entry 2022 (class 1259 OID 53240)
-- Dependencies: 1608
-- Name: jefe_pnf_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX jefe_pnf_pk ON jefe_pnf USING btree (idjefe);


--
-- TOC entry 2027 (class 1259 OID 53241)
-- Dependencies: 1610
-- Name: municipio_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX municipio_pk ON municipio USING btree (idmunicipio);


--
-- TOC entry 2031 (class 1259 OID 53242)
-- Dependencies: 1612
-- Name: noticia_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX noticia_pk ON noticia USING btree (idnoticia);


--
-- TOC entry 2035 (class 1259 OID 53243)
-- Dependencies: 1614
-- Name: parroquia_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX parroquia_pk ON parroquia USING btree (idparroquia);


--
-- TOC entry 2039 (class 1259 OID 53244)
-- Dependencies: 1616
-- Name: periodo_academico_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX periodo_academico_pk ON periodo_academico USING btree (idperiodo);


--
-- TOC entry 2042 (class 1259 OID 53245)
-- Dependencies: 1618
-- Name: personal_sector_comunidad_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX personal_sector_comunidad_pk ON personal_sector_comunidad USING btree (idpersona);


--
-- TOC entry 1951 (class 1259 OID 53246)
-- Dependencies: 1581
-- Name: pertenece1_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pertenece1_fk ON comision_tecnica USING btree (iddocente);


--
-- TOC entry 1952 (class 1259 OID 53247)
-- Dependencies: 1581
-- Name: pertenece2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pertenece2_fk ON comision_tecnica USING btree (idpersona);


--
-- TOC entry 2058 (class 1259 OID 53248)
-- Dependencies: 1624
-- Name: pertenece3_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pertenece3_fk ON proyecto USING btree (iddiagnostico);


--
-- TOC entry 2023 (class 1259 OID 53249)
-- Dependencies: 1608
-- Name: pertenece_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pertenece_fk ON jefe_pnf USING btree (idpnf);


--
-- TOC entry 2001 (class 1259 OID 53250)
-- Dependencies: 1601
-- Name: pertenecen_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pertenecen_fk ON estudiante USING btree (idpnf);


--
-- TOC entry 2049 (class 1259 OID 53251)
-- Dependencies: 1620
-- Name: pnf_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pnf_pk ON pnf USING btree (idpnf);


--
-- TOC entry 2073 (class 1259 OID 53252)
-- Dependencies: 1628
-- Name: posee_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX posee_fk ON seguridad USING btree (idusuario);


--
-- TOC entry 2052 (class 1259 OID 53253)
-- Dependencies: 1622
-- Name: problema_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX problema_pk ON problema USING btree (idproblema);


--
-- TOC entry 2061 (class 1259 OID 53254)
-- Dependencies: 1624
-- Name: proyecto_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX proyecto_pk ON proyecto USING btree (idproyecto);


--
-- TOC entry 2034 (class 1259 OID 53255)
-- Dependencies: 1612
-- Name: publica_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX publica_fk ON noticia USING btree (idusuario);


--
-- TOC entry 1979 (class 1259 OID 53256)
-- Dependencies: 1589
-- Name: puede_ser1_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puede_ser1_fk ON docente USING btree (idusuario);


--
-- TOC entry 2026 (class 1259 OID 53257)
-- Dependencies: 1608
-- Name: puede_ser2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puede_ser2_fk ON jefe_pnf USING btree (idusuario);


--
-- TOC entry 2004 (class 1259 OID 53258)
-- Dependencies: 1601
-- Name: puede_ser3_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puede_ser3_fk ON estudiante USING btree (idusuario);


--
-- TOC entry 1987 (class 1259 OID 53259)
-- Dependencies: 1593
-- Name: puede_tener2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puede_tener2_fk ON entproy USING btree (idproyecto);


--
-- TOC entry 1983 (class 1259 OID 53260)
-- Dependencies: 1591
-- Name: puede_tener3_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puede_tener3_fk ON entdiag USING btree (iddiagnostico);


--
-- TOC entry 1991 (class 1259 OID 53261)
-- Dependencies: 1595
-- Name: puede_tener_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puede_tener_fk ON entreanteproy USING btree (idantep);


--
-- TOC entry 1962 (class 1259 OID 53262)
-- Dependencies: 1585
-- Name: puedehacer_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puedehacer_fk ON denuncia USING btree (idusuario);


--
-- TOC entry 2045 (class 1259 OID 53263)
-- Dependencies: 1618
-- Name: puedeser2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puedeser2_fk ON personal_sector_comunidad USING btree (idusuario);


--
-- TOC entry 2062 (class 1259 OID 53264)
-- Dependencies: 1624
-- Name: puedetener1_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puedetener1_fk ON proyecto USING btree (idpnf);


--
-- TOC entry 1944 (class 1259 OID 53265)
-- Dependencies: 1579
-- Name: puedetener2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puedetener2_fk ON anteproyecto USING btree (idpnf);


--
-- TOC entry 1969 (class 1259 OID 53266)
-- Dependencies: 1587
-- Name: puedetener3_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puedetener3_fk ON diagnostico USING btree (idpnf);


--
-- TOC entry 2053 (class 1259 OID 53267)
-- Dependencies: 1622
-- Name: puedetener4_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX puedetener4_fk ON problema USING btree (idsectorcomunidad);


--
-- TOC entry 2014 (class 1259 OID 53268)
-- Dependencies: 1604
-- Name: realiza2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX realiza2_fk ON evaluacion_proyecto USING btree (idcomision);


--
-- TOC entry 1945 (class 1259 OID 53269)
-- Dependencies: 1579
-- Name: realizado_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX realizado_fk ON anteproyecto USING btree (idgrupo);


--
-- TOC entry 1946 (class 1259 OID 53270)
-- Dependencies: 1579
-- Name: relacionado_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relacionado_fk ON anteproyecto USING btree (idproblema);


--
-- TOC entry 1970 (class 1259 OID 53271)
-- Dependencies: 1587
-- Name: responsable_comunidad_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX responsable_comunidad_fk ON diagnostico USING btree (idpersona);


--
-- TOC entry 2015 (class 1259 OID 53272)
-- Dependencies: 1604
-- Name: se_le_realiza_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX se_le_realiza_fk ON evaluacion_proyecto USING btree (idproyecto);


--
-- TOC entry 2069 (class 1259 OID 53273)
-- Dependencies: 1626
-- Name: sector_comunidad_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sector_comunidad_pk ON sector_comunidad USING btree (idsectorcomunidad);


--
-- TOC entry 2081 (class 1259 OID 53599)
-- Dependencies: 1633
-- Name: sector_consejo_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sector_consejo_fk ON consejo_comunal USING btree (idsectorcomunidad);


--
-- TOC entry 2074 (class 1259 OID 53274)
-- Dependencies: 1628
-- Name: seguridad_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX seguridad_pk ON seguridad USING btree (idseguridad);


--
-- TOC entry 2063 (class 1259 OID 53275)
-- Dependencies: 1624
-- Name: solucionan_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX solucionan_fk ON proyecto USING btree (idproblema);


--
-- TOC entry 1947 (class 1259 OID 53276)
-- Dependencies: 1579
-- Name: tendra1_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tendra1_fk ON anteproyecto USING btree (idjefe);


--
-- TOC entry 1971 (class 1259 OID 53277)
-- Dependencies: 1587
-- Name: tendra2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tendra2_fk ON diagnostico USING btree (idjefe);


--
-- TOC entry 2064 (class 1259 OID 53278)
-- Dependencies: 1624
-- Name: tendra3_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tendra3_fk ON proyecto USING btree (idjefe);


--
-- TOC entry 2030 (class 1259 OID 53279)
-- Dependencies: 1610
-- Name: tiene2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene2_fk ON municipio USING btree (idestado);


--
-- TOC entry 2038 (class 1259 OID 53280)
-- Dependencies: 1614
-- Name: tiene3_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene3_fk ON parroquia USING btree (idmunicipio);


--
-- TOC entry 1958 (class 1259 OID 53281)
-- Dependencies: 1583
-- Name: tiene4_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene4_fk ON comunidad USING btree (idparroquia);


--
-- TOC entry 2070 (class 1259 OID 53282)
-- Dependencies: 1626
-- Name: tiene5_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene5_fk ON sector_comunidad USING btree (idcomuni);


--
-- TOC entry 2065 (class 1259 OID 53283)
-- Dependencies: 1624
-- Name: tiene6_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene6_fk ON proyecto USING btree (idperiodo);


--
-- TOC entry 1972 (class 1259 OID 53284)
-- Dependencies: 1587
-- Name: tiene7_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene7_fk ON diagnostico USING btree (idperiodo);


--
-- TOC entry 1948 (class 1259 OID 53285)
-- Dependencies: 1579
-- Name: tiene_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tiene_fk ON anteproyecto USING btree (idperiodo);


--
-- TOC entry 1949 (class 1259 OID 53286)
-- Dependencies: 1579
-- Name: tutoreada_a_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tutoreada_a_fk ON anteproyecto USING btree (doc_iddocente);


--
-- TOC entry 1973 (class 1259 OID 53287)
-- Dependencies: 1587
-- Name: tutoreada_d_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tutoreada_d_fk ON diagnostico USING btree (doc_iddocente);


--
-- TOC entry 2016 (class 1259 OID 53288)
-- Dependencies: 1604
-- Name: tutoreada_ep_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tutoreada_ep_fk ON evaluacion_proyecto USING btree (doc_iddocente);


--
-- TOC entry 2066 (class 1259 OID 53289)
-- Dependencies: 1624
-- Name: tutoreada_p_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tutoreada_p_fk ON proyecto USING btree (iddocente);


--
-- TOC entry 2017 (class 1259 OID 53290)
-- Dependencies: 1604
-- Name: tutoreada_psc_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX tutoreada_psc_fk ON evaluacion_proyecto USING btree (idpersona);


--
-- TOC entry 2077 (class 1259 OID 53291)
-- Dependencies: 1630
-- Name: usuario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX usuario_pk ON usuario USING btree (idusuario);


--
-- TOC entry 2046 (class 1259 OID 53292)
-- Dependencies: 1618
-- Name: viven_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX viven_fk ON personal_sector_comunidad USING btree (idsectorcomunidad);


--
-- TOC entry 2082 (class 2606 OID 53293)
-- Dependencies: 1587 1579 1967
-- Name: fk_anteproy_correspon_diagnost; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_correspon_diagnost FOREIGN KEY (iddiagnostico) REFERENCES diagnostico(iddiagnostico) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2083 (class 2606 OID 53298)
-- Dependencies: 1589 1579 1977
-- Name: fk_anteproy_facilita__docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_facilita__docente FOREIGN KEY (iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2084 (class 2606 OID 53303)
-- Dependencies: 1618 1579 2043
-- Name: fk_anteproy_figura2_personal; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_figura2_personal FOREIGN KEY (idpersona) REFERENCES personal_sector_comunidad(idpersona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2085 (class 2606 OID 53308)
-- Dependencies: 1620 1579 2047
-- Name: fk_anteproy_puedetene_pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_puedetene_pnf FOREIGN KEY (idpnf) REFERENCES pnf(idpnf) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2086 (class 2606 OID 53313)
-- Dependencies: 1606 1579 2019
-- Name: fk_anteproy_realizado_grupo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_realizado_grupo FOREIGN KEY (idgrupo) REFERENCES grupo(idgrupo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2087 (class 2606 OID 53318)
-- Dependencies: 1622 1579 2050
-- Name: fk_anteproy_relaciona_problema; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_relaciona_problema FOREIGN KEY (idproblema) REFERENCES problema(idproblema) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2088 (class 2606 OID 53323)
-- Dependencies: 1579 1608 2024
-- Name: fk_anteproy_tendra1_jefe_pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_tendra1_jefe_pnf FOREIGN KEY (idjefe) REFERENCES jefe_pnf(idjefe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2089 (class 2606 OID 53328)
-- Dependencies: 2040 1579 1616
-- Name: fk_anteproy_tiene_periodo_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_tiene_periodo_ FOREIGN KEY (idperiodo) REFERENCES periodo_academico(idperiodo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2090 (class 2606 OID 53333)
-- Dependencies: 1977 1579 1589
-- Name: fk_anteproy_tutoreada_docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anteproyecto
    ADD CONSTRAINT fk_anteproy_tutoreada_docente FOREIGN KEY (doc_iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2091 (class 2606 OID 53338)
-- Dependencies: 1614 2036 1583
-- Name: fk_comunida_tiene4_parroqui; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comunidad
    ADD CONSTRAINT fk_comunida_tiene4_parroqui FOREIGN KEY (idparroquia) REFERENCES parroquia(idparroquia) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2141 (class 2606 OID 53600)
-- Dependencies: 1633 2067 1626
-- Name: fk_consejo__sector_co_sector_c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY consejo_comunal
    ADD CONSTRAINT fk_consejo__sector_co_sector_c FOREIGN KEY (idsectorcomunidad) REFERENCES sector_comunidad(idsectorcomunidad) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2092 (class 2606 OID 53343)
-- Dependencies: 1585 1630 2075
-- Name: fk_denuncia_puedehace_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY denuncia
    ADD CONSTRAINT fk_denuncia_puedehace_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2093 (class 2606 OID 53348)
-- Dependencies: 1587 1626 2067
-- Name: fk_diagnost_correspon_sector_c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT fk_diagnost_correspon_sector_c FOREIGN KEY (idsectorcomunidad) REFERENCES sector_comunidad(idsectorcomunidad) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2094 (class 2606 OID 53353)
-- Dependencies: 1587 1606 2019
-- Name: fk_diagnost_entrega_grupo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT fk_diagnost_entrega_grupo FOREIGN KEY (idgrupo) REFERENCES grupo(idgrupo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2095 (class 2606 OID 53358)
-- Dependencies: 1587 1589 1977
-- Name: fk_diagnost_facilita__docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT fk_diagnost_facilita__docente FOREIGN KEY (iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2096 (class 2606 OID 53363)
-- Dependencies: 1587 1620 2047
-- Name: fk_diagnost_puedetene_pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT fk_diagnost_puedetene_pnf FOREIGN KEY (idpnf) REFERENCES pnf(idpnf) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2097 (class 2606 OID 53368)
-- Dependencies: 1618 1587 2043
-- Name: fk_diagnost_responsab_personal; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT fk_diagnost_responsab_personal FOREIGN KEY (idpersona) REFERENCES personal_sector_comunidad(idpersona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2098 (class 2606 OID 53373)
-- Dependencies: 1608 2024 1587
-- Name: fk_diagnost_tendra2_jefe_pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT fk_diagnost_tendra2_jefe_pnf FOREIGN KEY (idjefe) REFERENCES jefe_pnf(idjefe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2099 (class 2606 OID 53378)
-- Dependencies: 2040 1587 1616
-- Name: fk_diagnost_tiene7_periodo_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT fk_diagnost_tiene7_periodo_ FOREIGN KEY (idperiodo) REFERENCES periodo_academico(idperiodo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2100 (class 2606 OID 53383)
-- Dependencies: 1977 1587 1589
-- Name: fk_diagnost_tutoreada_docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY diagnostico
    ADD CONSTRAINT fk_diagnost_tutoreada_docente FOREIGN KEY (doc_iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2127 (class 2606 OID 53388)
-- Dependencies: 1622 1587 1967
-- Name: fk_diagnostico_puedetene_proble; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY problema
    ADD CONSTRAINT fk_diagnostico_puedetene_proble FOREIGN KEY (iddiagnostico) REFERENCES diagnostico(iddiagnostico);


--
-- TOC entry 2101 (class 2606 OID 53393)
-- Dependencies: 1620 2047 1589
-- Name: fk_docente_adscrito__pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docente
    ADD CONSTRAINT fk_docente_adscrito__pnf FOREIGN KEY (idpnf) REFERENCES pnf(idpnf) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2102 (class 2606 OID 53398)
-- Dependencies: 1589 1583 1956
-- Name: fk_docente_habitan_comunida; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docente
    ADD CONSTRAINT fk_docente_habitan_comunida FOREIGN KEY (idcomuni) REFERENCES comunidad(idcomuni) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2103 (class 2606 OID 53403)
-- Dependencies: 1589 1630 2075
-- Name: fk_docente_puede_ser_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY docente
    ADD CONSTRAINT fk_docente_puede_ser_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2104 (class 2606 OID 53408)
-- Dependencies: 1967 1587 1591
-- Name: fk_entdiag_puede_ten_diagnost; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entdiag
    ADD CONSTRAINT fk_entdiag_puede_ten_diagnost FOREIGN KEY (iddiagnostico) REFERENCES diagnostico(iddiagnostico) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2105 (class 2606 OID 53413)
-- Dependencies: 1593 2059 1624
-- Name: fk_entproy_puede_ten_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entproy
    ADD CONSTRAINT fk_entproy_puede_ten_proyecto FOREIGN KEY (idproyecto) REFERENCES proyecto(idproyecto) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2106 (class 2606 OID 53418)
-- Dependencies: 1595 1942 1579
-- Name: fk_entreant_puede_ten_anteproy; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY entreanteproy
    ADD CONSTRAINT fk_entreant_puede_ten_anteproy FOREIGN KEY (idantep) REFERENCES anteproyecto(idantep) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2107 (class 2606 OID 53423)
-- Dependencies: 1601 2019 1606
-- Name: fk_estudian_grupoestu_grupo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT fk_estudian_grupoestu_grupo FOREIGN KEY (idgrupo) REFERENCES grupo(idgrupo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2108 (class 2606 OID 53428)
-- Dependencies: 1601 1956 1583
-- Name: fk_estudian_habita_comunida; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT fk_estudian_habita_comunida FOREIGN KEY (idcomuni) REFERENCES comunidad(idcomuni) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2109 (class 2606 OID 53433)
-- Dependencies: 2047 1620 1601
-- Name: fk_estudian_pertenece_pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT fk_estudian_pertenece_pnf FOREIGN KEY (idpnf) REFERENCES pnf(idpnf) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2110 (class 2606 OID 53438)
-- Dependencies: 1601 2075 1630
-- Name: fk_estudian_puede_ser_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estudiante
    ADD CONSTRAINT fk_estudian_puede_ser_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2111 (class 2606 OID 53443)
-- Dependencies: 1597 1993 1603
-- Name: fk_evalentr_evalentre_entregab; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evalentre
    ADD CONSTRAINT fk_evalentr_evalentre_entregab FOREIGN KEY (identregable) REFERENCES entregables(identregable) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2112 (class 2606 OID 53448)
-- Dependencies: 1604 2012 1603
-- Name: fk_evalentr_evalentre_evaluaci; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evalentre
    ADD CONSTRAINT fk_evalentr_evalentre_evaluaci FOREIGN KEY (idevaluacion) REFERENCES evaluacion_proyecto(idevaluacion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2113 (class 2606 OID 53453)
-- Dependencies: 1606 2019 1604
-- Name: fk_evaluaci_evalua_grupo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion_proyecto
    ADD CONSTRAINT fk_evaluaci_evalua_grupo FOREIGN KEY (idgrupo) REFERENCES grupo(idgrupo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2114 (class 2606 OID 53458)
-- Dependencies: 1618 2043 1604
-- Name: fk_evaluaci_facilita__personal; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion_proyecto
    ADD CONSTRAINT fk_evaluaci_facilita__personal FOREIGN KEY (per_idpersona) REFERENCES personal_sector_comunidad(idpersona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2115 (class 2606 OID 53463)
-- Dependencies: 1589 1977 1604
-- Name: fk_evaluaci_facilitad_docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion_proyecto
    ADD CONSTRAINT fk_evaluaci_facilitad_docente FOREIGN KEY (iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2116 (class 2606 OID 53468)
-- Dependencies: 2059 1604 1624
-- Name: fk_evaluaci_se_le_rea_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion_proyecto
    ADD CONSTRAINT fk_evaluaci_se_le_rea_proyecto FOREIGN KEY (idproyecto) REFERENCES proyecto(idproyecto) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2117 (class 2606 OID 53473)
-- Dependencies: 1589 1977 1604
-- Name: fk_evaluaci_tutoreada_docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion_proyecto
    ADD CONSTRAINT fk_evaluaci_tutoreada_docente FOREIGN KEY (doc_iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2118 (class 2606 OID 53478)
-- Dependencies: 1604 1618 2043
-- Name: fk_evaluaci_tutoreada_personal; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion_proyecto
    ADD CONSTRAINT fk_evaluaci_tutoreada_personal FOREIGN KEY (idpersona) REFERENCES personal_sector_comunidad(idpersona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2119 (class 2606 OID 53483)
-- Dependencies: 1977 1608 1589
-- Name: fk_jefe_pnf_ejerce_docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY jefe_pnf
    ADD CONSTRAINT fk_jefe_pnf_ejerce_docente FOREIGN KEY (iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2120 (class 2606 OID 53488)
-- Dependencies: 1620 1608 2047
-- Name: fk_jefe_pnf_pertenece_pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY jefe_pnf
    ADD CONSTRAINT fk_jefe_pnf_pertenece_pnf FOREIGN KEY (idpnf) REFERENCES pnf(idpnf) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2121 (class 2606 OID 53493)
-- Dependencies: 1608 2075 1630
-- Name: fk_jefe_pnf_puede_ser_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY jefe_pnf
    ADD CONSTRAINT fk_jefe_pnf_puede_ser_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2122 (class 2606 OID 53498)
-- Dependencies: 1610 1599 1996
-- Name: fk_municipi_tiene2_estado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT fk_municipi_tiene2_estado FOREIGN KEY (idestado) REFERENCES estado(idestado) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2123 (class 2606 OID 53503)
-- Dependencies: 1612 1630 2075
-- Name: fk_noticia_publica_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY noticia
    ADD CONSTRAINT fk_noticia_publica_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2124 (class 2606 OID 53508)
-- Dependencies: 1614 1610 2028
-- Name: fk_parroqui_tiene3_municipi; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquia
    ADD CONSTRAINT fk_parroqui_tiene3_municipi FOREIGN KEY (idmunicipio) REFERENCES municipio(idmunicipio) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2125 (class 2606 OID 53513)
-- Dependencies: 1618 1630 2075
-- Name: fk_personal_puedeser2_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personal_sector_comunidad
    ADD CONSTRAINT fk_personal_puedeser2_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2126 (class 2606 OID 53518)
-- Dependencies: 1618 1626 2067
-- Name: fk_personal_viven_sector_c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY personal_sector_comunidad
    ADD CONSTRAINT fk_personal_viven_sector_c FOREIGN KEY (idsectorcomunidad) REFERENCES sector_comunidad(idsectorcomunidad) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2128 (class 2606 OID 53523)
-- Dependencies: 1622 1626 2067
-- Name: fk_problema_puedetene_sector_c; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY problema
    ADD CONSTRAINT fk_problema_puedetene_sector_c FOREIGN KEY (idsectorcomunidad) REFERENCES sector_comunidad(idsectorcomunidad) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2129 (class 2606 OID 53528)
-- Dependencies: 1624 1942 1579
-- Name: fk_proyecto_con_lleva_anteproy; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_con_lleva_anteproy FOREIGN KEY (idantep) REFERENCES anteproyecto(idantep) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2130 (class 2606 OID 53533)
-- Dependencies: 1624 1606 2019
-- Name: fk_proyecto_ejecutan_grupo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_ejecutan_grupo FOREIGN KEY (idgrupo) REFERENCES grupo(idgrupo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2131 (class 2606 OID 53538)
-- Dependencies: 1977 1624 1589
-- Name: fk_proyecto_facilitad_docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_facilitad_docente FOREIGN KEY (doc_iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2132 (class 2606 OID 53543)
-- Dependencies: 1618 1624 2043
-- Name: fk_proyecto_figura_personal; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_figura_personal FOREIGN KEY (idpersona) REFERENCES personal_sector_comunidad(idpersona) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2133 (class 2606 OID 53548)
-- Dependencies: 1587 1624 1967
-- Name: fk_proyecto_pertenece_diagnost; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_pertenece_diagnost FOREIGN KEY (iddiagnostico) REFERENCES diagnostico(iddiagnostico) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2134 (class 2606 OID 53553)
-- Dependencies: 1620 1624 2047
-- Name: fk_proyecto_puedetene_pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_puedetene_pnf FOREIGN KEY (idpnf) REFERENCES pnf(idpnf) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2135 (class 2606 OID 53558)
-- Dependencies: 1622 1624 2050
-- Name: fk_proyecto_soluciona_problema; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_soluciona_problema FOREIGN KEY (idproblema) REFERENCES problema(idproblema) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2136 (class 2606 OID 53563)
-- Dependencies: 1608 1624 2024
-- Name: fk_proyecto_tendra3_jefe_pnf; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_tendra3_jefe_pnf FOREIGN KEY (idjefe) REFERENCES jefe_pnf(idjefe) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2137 (class 2606 OID 53568)
-- Dependencies: 1616 1624 2040
-- Name: fk_proyecto_tiene6_periodo_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_tiene6_periodo_ FOREIGN KEY (idperiodo) REFERENCES periodo_academico(idperiodo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2138 (class 2606 OID 53573)
-- Dependencies: 1589 1624 1977
-- Name: fk_proyecto_tutoreada_docente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_tutoreada_docente FOREIGN KEY (iddocente) REFERENCES docente(iddocente) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2139 (class 2606 OID 53578)
-- Dependencies: 1583 1626 1956
-- Name: fk_sector_c_tiene5_comunida; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sector_comunidad
    ADD CONSTRAINT fk_sector_c_tiene5_comunida FOREIGN KEY (idcomuni) REFERENCES comunidad(idcomuni) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2140 (class 2606 OID 53583)
-- Dependencies: 2075 1628 1630
-- Name: fk_segurida_posee_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY seguridad
    ADD CONSTRAINT fk_segurida_posee_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2174 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2013-07-01 07:00:57

--
-- PostgreSQL database dump complete
--

