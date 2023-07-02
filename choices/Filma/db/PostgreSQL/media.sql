-- Database: media

-- DROP DATABASE IF EXISTS media;

CREATE DATABASE media
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'French_France.1252'
    LC_CTYPE = 'French_France.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

-- --------------------------------------------------------
-- Table: public.admins

-- DROP TABLE IF EXISTS public.admins;

CREATE TABLE IF NOT EXISTS public.admins
(
    id integer NOT NULL DEFAULT nextval('admins_id_seq'::regclass),
    username character varying(40) COLLATE pg_catalog."default" NOT NULL,
    password character varying(32) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT admins_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.admins
    OWNER to postgres;

-- --------------------------------------------------------
-- Table: public.comments

-- DROP TABLE IF EXISTS public.comments;

CREATE TABLE IF NOT EXISTS public.comments
(
    id integer NOT NULL DEFAULT nextval('comments_id_seq'::regclass),
    content text COLLATE pg_catalog."default" NOT NULL,
    id_video integer NOT NULL,
    id_owner integer NOT NULL,
    date character varying(15) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT comments_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.comments
    OWNER to postgres;

-- --------------------------------------------------------
-- Table: public.embedding

-- DROP TABLE IF EXISTS public.embedding;

CREATE TABLE IF NOT EXISTS public.embedding
(
    id integer NOT NULL DEFAULT nextval('embedding_id_seq'::regclass),
    video_id integer NOT NULL,
    video_text text COLLATE pg_catalog."default" NOT NULL,
    video_embedding text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT embedding_pkey PRIMARY KEY (id),
    CONSTRAINT embedding_video_id_fkey FOREIGN KEY (video_id)
        REFERENCES public.videos (id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.embedding
    OWNER to postgres;

-- --------------------------------------------------------
-- Table: public.requests

-- DROP TABLE IF EXISTS public.requests;

CREATE TABLE IF NOT EXISTS public.requests
(
    id integer NOT NULL DEFAULT nextval('requests_id_seq'::regclass),
    title character varying(70) COLLATE pg_catalog."default" NOT NULL,
    description text COLLATE pg_catalog."default",
    id_owner integer NOT NULL,
    vid_loca character varying(40) COLLATE pg_catalog."default" NOT NULL,
    thumbnail_loca character varying(40) COLLATE pg_catalog."default" NOT NULL,
    date character varying(15) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT requests_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.requests
    OWNER to postgres;

-- --------------------------------------------------------
-- Table: public.users

-- DROP TABLE IF EXISTS public.users;

CREATE TABLE IF NOT EXISTS public.users
(
    id integer NOT NULL DEFAULT nextval('users_id_seq'::regclass),
    username character varying(40) COLLATE pg_catalog."default" NOT NULL,
    fullname character varying(40) COLLATE pg_catalog."default" NOT NULL,
    email character varying(40) COLLATE pg_catalog."default" NOT NULL,
    password character varying(32) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT users_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.users
    OWNER to postgres;

-- --------------------------------------------------------
-- Table: public.videos

-- DROP TABLE IF EXISTS public.videos;

CREATE TABLE IF NOT EXISTS public.videos
(
    id integer NOT NULL DEFAULT nextval('videos_id_seq'::regclass),
    title character varying(70) COLLATE pg_catalog."default" NOT NULL,
    description text COLLATE pg_catalog."default",
    id_owner integer NOT NULL,
    vid_loca character varying(40) COLLATE pg_catalog."default" NOT NULL,
    thumbnail_loca character varying(40) COLLATE pg_catalog."default" NOT NULL,
    date character varying(15) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT videos_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.videos
    OWNER to postgres;

-- --------------------------------------------------------
-- Table: public.votes

-- DROP TABLE IF EXISTS public.votes;

CREATE TABLE IF NOT EXISTS public.votes
(
    id integer NOT NULL DEFAULT nextval('votes_id_seq'::regclass),
    vote integer NOT NULL,
    id_vid integer NOT NULL,
    id_owner integer NOT NULL,
    CONSTRAINT votes_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.votes
    OWNER to postgres;