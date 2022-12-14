PGDMP                     
    z            assinatura_email    11.1 (Debian 11.1-1.pgdg90+1)    14.4     l           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            m           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            n           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            o           1262    538905    assinatura_email    DATABASE     d   CREATE DATABASE assinatura_email WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'en_US.utf8';
     DROP DATABASE assinatura_email;
                postgres    false            ?            1259    538909 	   tbl_cargo    TABLE     Z   CREATE TABLE public.tbl_cargo (
    id_cargo integer NOT NULL,
    cargo text NOT NULL
);
    DROP TABLE public.tbl_cargo;
       public            postgres    false            ?            1259    604549    tbl_cargo_id_cargo_seq    SEQUENCE     ?   ALTER TABLE public.tbl_cargo ALTER COLUMN id_cargo ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tbl_cargo_id_cargo_seq
    START WITH 15
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    196            ?            1259    538917    tbl_empresa    TABLE     `   CREATE TABLE public.tbl_empresa (
    id_empresa integer NOT NULL,
    empresa text NOT NULL
);
    DROP TABLE public.tbl_empresa;
       public            postgres    false            ?            1259    604547    tbl_empresa_id_empresa_seq    SEQUENCE     ?   ALTER TABLE public.tbl_empresa ALTER COLUMN id_empresa ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tbl_empresa_id_empresa_seq
    START WITH 9
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    197            ?            1259    538925 	   tbl_ramal    TABLE     u   CREATE TABLE public.tbl_ramal (
    id_ramal integer NOT NULL,
    ramal text NOT NULL,
    sala integer NOT NULL
);
    DROP TABLE public.tbl_ramal;
       public            postgres    false            ?            1259    604545    tbl_ramal_id_ramal_seq    SEQUENCE     ?   ALTER TABLE public.tbl_ramal ALTER COLUMN id_ramal ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tbl_ramal_id_ramal_seq
    START WITH 53
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    198            ?            1259    538933 	   tbl_setor    TABLE     Z   CREATE TABLE public.tbl_setor (
    id_setor integer NOT NULL,
    setor text NOT NULL
);
    DROP TABLE public.tbl_setor;
       public            postgres    false            ?            1259    604543    tbl_setor_id_setor_seq    SEQUENCE     ?   ALTER TABLE public.tbl_setor ALTER COLUMN id_setor ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tbl_setor_id_setor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    199            ?            1259    604703    tbl_tipo_login    TABLE     i   CREATE TABLE public.tbl_tipo_login (
    id_tipo_login integer NOT NULL,
    tipo_login text NOT NULL
);
 "   DROP TABLE public.tbl_tipo_login;
       public            postgres    false            ?            1259    604701     tbl_tipo_login_id_tipo_login_seq    SEQUENCE     ?   ALTER TABLE public.tbl_tipo_login ALTER COLUMN id_tipo_login ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tbl_tipo_login_id_tipo_login_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    209            ?            1259    538941    tbl_user_ass    TABLE     ?  CREATE TABLE public.tbl_user_ass (
    id_user_ass integer NOT NULL,
    nome_user_ass text NOT NULL,
    email_user_ass text NOT NULL,
    telefone_user_ass text NOT NULL,
    last_update_user_ass date NOT NULL,
    "isCoordenador" boolean NOT NULL,
    id_coordenador integer,
    id_cargo_user_ass integer NOT NULL,
    id_setor_user_ass integer NOT NULL,
    id_ramal_user_ass integer NOT NULL,
    id_empresa_user_ass integer NOT NULL
);
     DROP TABLE public.tbl_user_ass;
       public            postgres    false            ?            1259    547104    tbl_user_ass_id_user_ass_seq    SEQUENCE     ?   ALTER TABLE public.tbl_user_ass ALTER COLUMN id_user_ass ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tbl_user_ass_id_user_ass_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    200            ?            1259    571675    tbl_user_login    TABLE     ?   CREATE TABLE public.tbl_user_login (
    id_user_login integer NOT NULL,
    usuario_user_login text NOT NULL,
    senha_user_login text NOT NULL
);
 "   DROP TABLE public.tbl_user_login;
       public            postgres    false            ?            1259    571673     tbl_user_login_id_user_login_seq    SEQUENCE     ?   ALTER TABLE public.tbl_user_login ALTER COLUMN id_user_login ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.tbl_user_login_id_user_login_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    203            ?
           2606    538916    tbl_cargo tbl_cargo_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tbl_cargo
    ADD CONSTRAINT tbl_cargo_pkey PRIMARY KEY (id_cargo);
 B   ALTER TABLE ONLY public.tbl_cargo DROP CONSTRAINT tbl_cargo_pkey;
       public            postgres    false    196            ?
           2606    538924    tbl_empresa tbl_empresa_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.tbl_empresa
    ADD CONSTRAINT tbl_empresa_pkey PRIMARY KEY (id_empresa);
 F   ALTER TABLE ONLY public.tbl_empresa DROP CONSTRAINT tbl_empresa_pkey;
       public            postgres    false    197            ?
           2606    538929    tbl_ramal tbl_ramal_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tbl_ramal
    ADD CONSTRAINT tbl_ramal_pkey PRIMARY KEY (id_ramal);
 B   ALTER TABLE ONLY public.tbl_ramal DROP CONSTRAINT tbl_ramal_pkey;
       public            postgres    false    198            ?
           2606    538940    tbl_setor tbl_setor_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.tbl_setor
    ADD CONSTRAINT tbl_setor_pkey PRIMARY KEY (id_setor);
 B   ALTER TABLE ONLY public.tbl_setor DROP CONSTRAINT tbl_setor_pkey;
       public            postgres    false    199            ?
           2606    604710 "   tbl_tipo_login tbl_tipo_login_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.tbl_tipo_login
    ADD CONSTRAINT tbl_tipo_login_pkey PRIMARY KEY (id_tipo_login);
 L   ALTER TABLE ONLY public.tbl_tipo_login DROP CONSTRAINT tbl_tipo_login_pkey;
       public            postgres    false    209            ?
           2606    538948    tbl_user_ass tbl_user_ass_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public.tbl_user_ass
    ADD CONSTRAINT tbl_user_ass_pkey PRIMARY KEY (id_user_ass);
 H   ALTER TABLE ONLY public.tbl_user_ass DROP CONSTRAINT tbl_user_ass_pkey;
       public            postgres    false    200            ?
           2606    571682 "   tbl_user_login tbl_user_login_pkey 
   CONSTRAINT     k   ALTER TABLE ONLY public.tbl_user_login
    ADD CONSTRAINT tbl_user_login_pkey PRIMARY KEY (id_user_login);
 L   ALTER TABLE ONLY public.tbl_user_login DROP CONSTRAINT tbl_user_login_pkey;
       public            postgres    false    203            ?
           2606    538959    tbl_user_ass cargo    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tbl_user_ass
    ADD CONSTRAINT cargo FOREIGN KEY (id_cargo_user_ass) REFERENCES public.tbl_cargo(id_cargo) NOT VALID;
 <   ALTER TABLE ONLY public.tbl_user_ass DROP CONSTRAINT cargo;
       public          postgres    false    2784    200    196            ?
           2606    538969    tbl_user_ass empresa    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tbl_user_ass
    ADD CONSTRAINT empresa FOREIGN KEY (id_empresa_user_ass) REFERENCES public.tbl_empresa(id_empresa) NOT VALID;
 >   ALTER TABLE ONLY public.tbl_user_ass DROP CONSTRAINT empresa;
       public          postgres    false    200    197    2786            ?
           2606    538974    tbl_user_ass ramal    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tbl_user_ass
    ADD CONSTRAINT ramal FOREIGN KEY (id_ramal_user_ass) REFERENCES public.tbl_ramal(id_ramal) NOT VALID;
 <   ALTER TABLE ONLY public.tbl_user_ass DROP CONSTRAINT ramal;
       public          postgres    false    2788    200    198            ?
           2606    538964    tbl_user_ass setor    FK CONSTRAINT     ?   ALTER TABLE ONLY public.tbl_user_ass
    ADD CONSTRAINT setor FOREIGN KEY (id_setor_user_ass) REFERENCES public.tbl_setor(id_setor) NOT VALID;
 <   ALTER TABLE ONLY public.tbl_user_ass DROP CONSTRAINT setor;
       public          postgres    false    199    200    2790           