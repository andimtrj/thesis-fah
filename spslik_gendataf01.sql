-- FUNCTION: public.spslik_gendataf01(timestamp without time zone, timestamp without time zone, character varying, character varying, character varying, bigint)

-- DROP FUNCTION IF EXISTS public.spslik_gendataf01(timestamp without time zone, timestamp without time zone, character varying, character varying, character varying, bigint);

CREATE OR REPLACE FUNCTION public.spslik_gendataf01(
	schedulestartdate timestamp without time zone DEFAULT NULL::timestamp without time zone,
	scheduleenddate timestamp without time zone DEFAULT NULL::timestamp without time zone,
	periodmonth character varying DEFAULT NULL::character varying,
	periodyear character varying DEFAULT NULL::character varying,
	"user" character varying DEFAULT NULL::character varying,
	scheduleid bigint DEFAULT NULL::bigint)
    RETURNS TABLE(flagdtl text, "PeriodMonth" integer, "Periodyear" integer, norekfasilitas integer, nocif integer, kdsifatkredit text, kdjeniskredit text, akadpembiyaan text, noakadawal integer, tglakadawal timestamp without time zone, noakadakhr integer, tglakadakhr timestamp without time zone, baruperpjgan text, tglawalkredit timestamp without time zone, tglmulai timestamp without time zone, tgljthtmp timestamp without time zone, kdktgrdebt text, kdjnspenggunaan text, kdorientasipenggunaan text, kdsectoreconomy text, lokasiproyekdati2 text, nlproyek integer, kdvaluta text, prcntgsukubng integer, jnssukubng integer, kreditpembiayaanprogpmrnth integer, takeoverdari text, sumberdana integer, plafonawal integer, plafon integer, pncairanblnbrjln integer, denda integer, bakidebet integer, nldlmmtuangasal integer, kdkolektibilitas text, tglmacet timestamp without time zone, kodesebabmacet text, tunggakanpkk integer, tunggakanbng integer, jmlhhrtunggakan integer, frektunggakan integer, frekrestrukturisasi integer, tglrestrukturawal timestamp without time zone, tglrestrukturakhr timestamp without time zone, kdcararestruktur text, kdkondisi text, tglkondisi timestamp without time zone, keterangan text, kdkntrcbg text, operasidata text, usrcrt name, dtmcrt timestamp without time zone, usrupd name, dtmupd timestamp without time zone) 
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$

   DECLARE
   v_BusinessDate  TIMESTAMP DEFAULT(SELECT SYS_VALUE FROM public.FOUNDATION_SYS_CTRL_COY WHERE SYS_KEY = 'BusinessDate');
   v_offset INT := 0;
   v_row_count INT;
   v_batch_size INT := 10000; -- Adjusted batch size for better performance
BEGIN
-- This procedure was converted on Fri Nov 03 15:18:18 2023 using Ispirer SQLWays 10.11 Build 7628 Revision 0 64bit Licensed to adins.udemy - Ispirer SQLWays Toolkit 10 Microsoft SQL Server to PostgreSQL Standart S License (1 month, 20231113).

	IF EXISTS(SELECT 1 FROM public.SLIK_CREDIT_DTA WHERE PERIOD_MONTH = PeriodMonth AND PERIOD_YEAR = PeriodYear) THEN --change SELECT '' into SELECT 1
		DELETE FROM public.SLIK_CREDIT_DTA WHERE PERIOD_MONTH = PeriodMonth AND PERIOD_YEAR = PeriodYear;
   	END IF;

	IF v_BusinessDate <= scheduleenddate THEN
        scheduleenddate := v_BusinessDate - INTERVAL '1 day';
    END IF;
--===========================CREATE & INSERT tt_ZIPCODE_DATA DATA================================================================
   DROP TABLE IF EXISTS tt_ZIPCODE_DATA CASCADE;
   CREATE TEMPORARY TABLE tt_ZIPCODE_DATA
   (
      ZIPCODE varchar,
      CITY varchar,
      AREA_CODE_2 varchar,
      AREA_CODE_1 varchar,
      REF_PROV_DISTRICT_ID bigint
   );
   INSERT INTO tt_ZIPCODE_DATA(
		ZIPCODE,
		CITY,
		AREA_CODE_2 ,
	    AREA_CODE_1 ,
	    REF_PROV_DISTRICT_ID 
	)
	SELECT ZIPCODE, CITY, AREA_CODE_2, AREA_CODE_1, REF_PROV_DISTRICT_ID
	FROM PUBLIC.FOUNDATION_REF_ZIPCODE
	WHERE is_active = TRUE
	GROUP BY ZIPCODE,CITY,AREA_CODE_2,AREA_CODE_1,REF_PROV_DISTRICT_ID;

	CREATE INDEX "ix_#zipcode_data_zipcode_area_code1_area_code2" ON tt_ZIPCODE_DATA (zipcode, area_code_1, area_code_2) WITH (FILLFACTOR = 70)
	INCLUDE	(
				ZIPCODE,
				REF_PROV_DISTRICT_ID 
			);

	CREATE INDEX "ix_#zipcode_data_ref_prov_district_id" ON tt_ZIPCODE_DATA (ref_prov_district_id)
	INCLUDE	(
				zipcode, 
				area_code_1, 
				area_code_2
			);

--=================CREATE & INSERT AGREEMENT TEMP TABLE=======================================================================
	RAISE NOTICE 'Start Insert tt_AGRMNT_TEMP';

   DROP TABLE IF EXISTS tt_AGRMNT_TEMP;
   CREATE TEMPORARY TABLE tt_AGRMNT_TEMP
   (
		AGRMNT_ID BIGINT,
		AGRMNT_NO VARCHAR,
		CONTRACT_STAT_CODE VARCHAR,
		GO_LIVE_DT TIMESTAMP WITHOUT TIME ZONE,
		MATURITY_DT TIMESTAMP WITHOUT TIME ZONE,
		EFFECTIVE_RATE_PRCNT NUMERIC,
		INTEREST_TYPE VARCHAR,
		NTF_AMT NUMERIC,
		DEFAULT_STAT_CODE VARCHAR,
		LBPPMS_CLCTBLTY_CODE VARCHAR,
		OS_PRINCIPAL_AMT NUMERIC, 
		OS_INTEREST_AMT NUMERIC,
		NEXT_INST_DT TIMESTAMP WITHOUT TIME ZONE,
		CUST_NO VARCHAR,
		OFFICE_CODE VARCHAR,
		CURR_CODE VARCHAR,
		AGRMNT_DT TIMESTAMP WITHOUT TIME ZONE
   );

	v_offset := 0;
    LOOP
        INSERT INTO tt_AGRMNT_TEMP 
        (		
            AGRMNT_ID,
            AGRMNT_NO,
            CONTRACT_STAT_CODE,
            GO_LIVE_DT,
            MATURITY_DT,
            EFFECTIVE_RATE_PRCNT,
            INTEREST_TYPE,
            NTF_AMT,
            DEFAULT_STAT_CODE,
            LBPPMS_CLCTBLTY_CODE,
            OS_PRINCIPAL_AMT, 
            OS_INTEREST_AMT,
            NEXT_INST_DT,
            CUST_NO,
            OFFICE_CODE,
            CURR_CODE,
            AGRMNT_DT
        )
        SELECT 
            AGRMNT_ID,
            AGRMNT_NO,
            CONTRACT_STAT_CODE,
            GO_LIVE_DT,
            MATURITY_DT,
            EFFECTIVE_RATE_PRCNT,
            INTEREST_TYPE,
            NTF_AMT,
            DEFAULT_STAT_CODE,
            LBPPMS_CLCTBLTY_CODE,
            OS_PRINCIPAL_AMT, 
            OS_INTEREST_AMT,
            NEXT_INST_DT,
            CUST_NO,
            OFFICE_CODE,
            CURR_CODE,
            AGRMNT_DT
        FROM AR_AGRMNT
        LIMIT batch_size
        OFFSET v_offset;

		GET DIAGNOSTICS v_row_count = ROW_COUNT; -- Get the number of rows inserted
		-- Exit the loop if no more rows are inserted
		EXIT WHEN v_row_count < v_batch_size;

        v_offset := v_offset + batch_size;
	END LOOP;
	
	CREATE INDEX "ix_#agrmnt_temp_contract_stat_code_default_stat_code" ON tt_agrmnt_temp (contract_stat_code, default_stat_code) WITH (FILLFACTOR = 70);

	CREATE INDEX "ix_#agrmnt_temp_agrmnt_id" ON tt_agrmnt_temp (agrmnt_id)
	INCLUDE
	(
		AGRMNT_NO,
		CONTRACT_STAT_CODE,
		GO_LIVE_DT,
		MATURITY_DT,
		EFFECTIVE_RATE_PRCNT,
		INTEREST_TYPE,
		NTF_AMT,
		OS_PRINCIPAL_AMT,
		DEFAULT_STAT_CODE,
		LBPPMS_CLCTBLTY_CODE,
		OS_PRINCIPAL_AMT,
		OS_INTEREST_AMT,
		NEXT_INST_DT,
		CUST_NO,
		CURR_CODE,
		OFFICE_CODE,
		AGRMNT_DT
	);

	CREATE INDEX "ix_#agrmnt_temp_agrmnt_no" ON tt_agrmnt_temp (agrmnt_no);

	CREATE INDEX "ix_#agrmnt_temp_office_code" ON tt_agrmnt_temp (office_code);

-- =======================CREATE & INSERT tt_TEMP_LC_ON_THE_FLY DATA BATCH=============================================================
	DROP TABLE IF EXISTS tt_TEMP_LC_ON_THE_FLY CASCADE;
	CREATE TEMPORARY TABLE tt_TEMP_LC_ON_THE_FLY
	(
		AGING_DT TIMESTAMP,
		AGRMNT_ID BIGINT,
		LC_AMT DECIMAL(17,2)
	);

	v_offset := 0;	
	LOOP
		INSERT INTO tt_TEMP_LC_ON_THE_FLY(AGING_DT, AGRMNT_ID, LC_AMT)
		SELECT 
			v_BusinessDate,
			A.AGRMNT_ID
			, public.fncalculate_lcagrmnt_v2(A.AGRMNT_ID, v_BusinessDate) --Migrate Function From AR, avoid using dblink -Fernaldy
		FROM tt_AGRMNT_TEMP A 
		WHERE A.CONTRACT_STAT_CODE IN ('LIV', 'ICP')
		ORDER BY A.AGRMNT_ID -- Ensures consistent ordering
		LIMIT v_batch_size OFFSET v_offset; -- Select a batch of rows

		GET DIAGNOSTICS v_row_count = ROW_COUNT; -- Get the number of rows inserted
		-- Exit the loop if no more rows are inserted
		EXIT WHEN v_row_count < v_batch_size;

		v_offset := v_offset + v_batch_size; -- Move the offset for the next batch
    
	END LOOP;
--=============================CREATE & INSERT tt_AGRMNT_RESCH DATA ========================================================
   DROP TABLE IF EXISTS tt_AGRMNT_RESCH CASCADE;
   CREATE TEMPORARY TABLE tt_AGRMNT_RESCH
   (
      AGRMNT_ID BIGINT,
      NUM_RESCH INTEGER,
      MIN_RESCH_DT TIMESTAMP,
      MAX_RESCH_DT TIMESTAMP,
      MAX_AMENDMENT_HIST_TRX_ID BIGINT
   );
	INSERT INTO tt_AGRMNT_RESCH(AGRMNT_ID,
		NUM_RESCH,
		MIN_RESCH_DT,
		MAX_RESCH_DT,
		MAX_AMENDMENT_HIST_TRX_ID)
	SELECT	
		AGR.AGRMNT_ID,
		COUNT(1) AS NUM_RESCH,
		MIN(AHT.EFFECTIVE_DT) AS MIN_RESCH_DT,
		MAX(AHT.EFFECTIVE_DT) AS MAX_RESCH_DT,
		MAX(AHT.AMENDMENT_HIST_TRX_ID) AS MAX_AMENDMENT_HIST_TRX_ID
	FROM public.AMENDMENT_AMENDMENT_HIST_TRX AHT 
	INNER JOIN tt_AGRMNT_TEMP AGR  ON AHT.AGRMNT_NO = AGR.AGRMNT_NO
	INNER JOIN public.AMENDMENT_AMENDMENT_TYPE AMT  ON AHT.AMENDMENT_TYPE_ID = AMT.AMENDMENT_TYPE_ID AND AMT.AMENDMENT_TYPE_CODE = 'RSC'
	WHERE AHT.AMENDMENT_STAT_CODE = 'EXE'
	GROUP BY AGR.AGRMNT_ID;

	CREATE INDEX "ix_#agrmnt_resch_agrmnt_id" ON tt_agrmnt_resch (agrmnt_id) 
	INCLUDE (
				NUM_RESCH,
				MIN_RESCH_DT,
				MAX_RESCH_DT,
				MAX_AMENDMENT_HIST_TRX_ID
			);

	CREATE INDEX "ix_#agrmnt_resch_max_amendment_hist_trx_id" ON tt_agrmnt_resch (max_amendment_hist_trx_id)
	INCLUDE (
				agrmnt_id,
				NUM_RESCH,
				MIN_RESCH_DT,
				MAX_RESCH_DT
			);

--========================CREATE & INSERT tt_AGRMNT_ACC_MNT_TEMP DATA=============================================================
   DROP TABLE IF EXISTS tt_AGRMNT_ACC_MNT_TEMP CASCADE;
   CREATE TEMPORARY TABLE tt_AGRMNT_ACC_MNT_TEMP
   (
	AGRMNT_ID BIGINT,
	RRD_DT TIMESTAMP WITHOUT TIME ZONE,
	WO_DT TIMESTAMP WITHOUT TIME ZONE
   )

	v_offset := 0;
	LOOP
		INSERT INTO tt_AGRMNT_ACC_MNT_TEMP
		(
			AGRMNT_ID,
			RRD_DT,
			WO_DT
		)
		SELECT
			AGRMNT_ID,
			RRD_DT,
			WO_DT
		FROM AR_AGRMNT_ACC_MNT
		LIMIT batch_size
		OFFSET v_offset;

		GET DIAGNOSTICS v_row_count = ROW_COUNT; -- Get the number of rows inserted
		-- Exit the loop if no more rows are inserted
		EXIT WHEN v_row_count < v_batch_size;

		v_offset := v_offset + batch_size;
	END LOOP;

	CREATE INDEX "ix_#agrmnt_acc_mnt_temp_agrmnt_id" ON tt_AGRMNT_ACC_MNT_TEMP (agrmnt_id)
	INCLUDE
	(
		RRD_DT,
		WO_DT
	);
-- =================================CREATE & INSERT tt_DAILY_AGING_TEMP DATA==========================================
	RAISE NOTICE 'Start Insert tt_DAILY_AGING_TEMP';
	DROP TABLE IF EXISTS tt_DAILY_AGING_TEMP CASCADE;
	CREATE TEMPORARY TABLE tt_DAILY_AGING_TEMP
	(
		AGRMNT_ID BIGINT,
		OS_PRINCIPAL_TOTAL_AMT DECIMAL(17,2),
		OS_INTEREST_TOTAL_AMT DECIMAL(17,2),
		OS_PRINCIPAL_UNDUE_AMT DECIMAL(17,2),
		OS_INTEREST_UNDUE_AMT DECIMAL(17,2),
		OS_LC_INST DECIMAL(17,2),
		DAYS_OVER_DUE INTEGER,
		CONTRACT_STAT_CODE VARCHAR(3),
		DEFAULT_STAT_CODE VARCHAR(3),
		AGING_DT TIMESTAMP
	);
	
	v_offset := 0;
	LOOP
		INSERT INTO tt_DAILY_AGING_TEMP(
			AGRMNT_ID,
			OS_PRINCIPAL_TOTAL_AMT,
			OS_INTEREST_TOTAL_AMT,
			OS_PRINCIPAL_UNDUE_AMT,
			OS_INTEREST_UNDUE_AMT,
			OS_LC_INST,
			DAYS_OVER_DUE,
			CONTRACT_STAT_CODE,
			DEFAULT_STAT_CODE,
			AGING_DT
		)
		SELECT	
			DA.AGRMNT_ID,
			OS_PRINCIPAL_TOTAL_AMT,
			OS_INTEREST_TOTAL_AMT,
			OS_PRINCIPAL_UNDUE_AMT,
			OS_INTEREST_UNDUE_AMT,
			(CASE WHEN((LC_INST_AMT + COALESCE(LC.LC_AMT,0)) - LC_INST_PAID_AMT - LC_INST_WAIVED_AMT) < 0 then 0 else((LC_INST_AMT+COALESCE(LC.LC_AMT,0)) -LC_INST_PAID_AMT -LC_INST_WAIVED_AMT) end) AS OS_LC_INST,
			DAYS_OVER_DUE,
			CONTRACT_STAT_CODE,
			DEFAULT_STAT_CODE,
			DA.AGING_DT
		FROM public.AR_DAILY_AGING DA 
		LEFT JOIN tt_TEMP_LC_ON_THE_FLY LC  ON LC.AGRMNT_ID = DA.AGRMNT_ID AND LC.AGING_DT = DA.AGING_DT
		WHERE DA.AGING_DT = ScheduleEndDate AND CONTRACT_STAT_CODE != 'EXP'
		UNION
		SELECT 	
			AGRACC.AGRMNT_ID,
			NULL,
			NULL,
			NULL,
			NULL,
			NULL,
			NULL,
			CONTRACT_STAT_CODE,
			DEFAULT_STAT_CODE,
			NULL
		FROM tt_AGRMNT_ACC_MNT_TEMP AGRACC
		LEFT JOIN tt_AGRMNT_TEMP AGR ON AGRACC.AGRMNT_ID = AGR.AGRMNT_ID
		LEFT JOIN AR_REFUND_AGRMNT_X REF ON AGRACC.AGRMNT_ID = REF.AGRMNT_ID
		WHERE (AGRACC.RRD_DT >= ScheduleStartDate AND AGRACC.RRD_DT <= ScheduleEndDate)
		OR (REF.REFUND_DT >= ScheduleStartDate AND REF.REFUND_DT <= ScheduleEndDate)
		LIMIT batch_size
		OFFSET v_offset;

		GET DIAGNOSTICS v_row_count = ROW_COUNT; -- Get the number of rows inserted
		-- Exit the loop if no more rows are inserted
		EXIT WHEN v_row_count < v_batch_size;

		v_offset := v_offset + batch_size;

		--AND AGR.GO_LIVE_DT >= ScheduleStartDate AND AGR.GO_LIVE_DT <= ScheduleEndDate; 
	END LOOP

	CREATE INDEX "IX_#DAILY_AGING_TEMP"
	ON tt_DAILY_AGING_TEMP 
	(AGRMNT_ID)
	INCLUDE(OS_PRINCIPAL_TOTAL_AMT,OS_INTEREST_TOTAL_AMT,OS_PRINCIPAL_UNDUE_AMT,OS_INTEREST_UNDUE_AMT,
	OS_LC_INST,DAYS_OVER_DUE,CONTRACT_STAT_CODE,DEFAULT_STAT_CODE);



-- =========================CREATE & INSERT tt_CUST_ADDR_TEMP=================================================================================== 
	DROP TABLE IF EXISTS tt_CUST_ADDR_TEMP CASCADE;
	CREATE TEMPORARY TABLE tt_CUST_ADDR_TEMP
	(
		CUST_NO VARCHAR,
		CUST_ID BIGINT,
		MR_CUST_ADDR_TYPE_CODE VARCHAR,
		ZIPCODE VARCHAR,
		AREA_CODE_1 VARCHAR,
		AREA_CODE_2 VARCHAR,
		CITY VARCHAR
	);

	LOOP
		INSERT INTO tt_CUST_ADDR_TEMP
		(
			CUST_NO,
			CUST_ID,
			MR_CUST_ADDR_TYPE_CODE,
			ZIPCODE,
			AREA_CODE_1,
			AREA_CODE_2,
			CITY
		)
		SELECT
			CUST.CUST_NO,
			CUST.CUST_ID,
			CA.MR_CUST_ADDR_TYPE_CODE,
			CA.ZIPCODE,
			CA.AREA_CODE_1,
			CA.AREA_CODE_2,
			CA.CITY
		FROM FOUNDATION_CUST CUST
		LEFT JOIN FOUNDATION_CUST_ADDR CA ON CUST.CUST_ID = CA.CUST_ID AND CA.mr_cust_addr_type_code = 'LEGAL'
		LIMIT batch_size
		OFFSET v_offset;

		GET DIAGNOSTICS v_row_count = ROW_COUNT; -- Get the number of rows inserted
		-- Exit the loop if no more rows are inserted
		EXIT WHEN v_row_count < v_batch_size;

		v_offset := v_offset + batch_size;

	END LOOP
	CREATE INDEX "ix_#cust_addr_temp_cust_no" ON tt_cust_addr_temp (cust_no)
	INCLUDE
	(
		CUST_ID,
		MR_CUST_ADDR_TYPE_CODE,
		ZIPCODE,
		AREA_CODE_1,
		AREA_CODE_2,
		CITY
	);

	CREATE INDEX "ix_#cust_addr_temp_zipcode_area_code" ON tt_cust_addr_temp (area_code_1, area_code_2, city);
	
	CREATE INDEX "ix_#cust_addr_temp_cust_id" ON tt_cust_addr_temp (cust_id);

--===========================CREATE & INSERT tt_agrmnt_government_regulation DATA==========================================
	DROP TABLE IF EXISTS tt_agrmnt_government_regulation CASCADE;
	CREATE TEMPORARY TABLE tt_agrmnt_government_regulation
	(
		AGRMNT_ID BIGINT,
		GOVERMENT_REGULATION_CODE VARCHAR,
		GOVERMENT_REGULATION_VALUE VARCHAR
	);

	LOOP
		INSERT INTO tt_agrmnt_government_regulation
		(
			AGRMNT_ID,
			GOVERMENT_REGULATION_CODE,
			GOVERMENT_REGULATION_VALUE
		)
		SELECT
			AGRMNT_ID,
			GOVERMENT_REGULATION_CODE,
			GOVERMENT_REGULATION_VALUE
		FROM 
			AR_AGRMNT_GOVERMENT_REGULATION
		LIMIT batch_size
		OFFSET v_offset;

		GET DIAGNOSTICS v_row_count = ROW_COUNT; -- Get the number of rows inserted
		-- Exit the loop if no more rows are inserted
		EXIT WHEN v_row_count < v_batch_size;

		v_offset := v_offset + batch_size;
		
	END LOOP;

	CREATE INDEX "ix_#agrmnt_gvrmnt_rgltion_temp_agrmnt_id" ON tt_agrmnt_government_regulation (agrmnt_id)
	INCLUDE
	(
		goverment_regulation_value
	);

	CREATE INDEX "ix_#agrmnt_gvrmnt_rgltion_temp_gvrmnt_rgltion_code" ON tt_agrmnt_government_regulation (goverment_regulation_code);

--==========================CREATE & INSERT tt_INST_SCHDL_TEMP DATA================================================================
	DROP TABLE IF EXISTS tt_INST_SCHDL_TEMP CASCADE;
	CREATE TEMPORARY TABLE tt_INST_SCHDL_TEMP
	(
		AGRMNT_ID BIGINT,
		INST_AMT NUMERIC,
		INST_PAID_AMT NUMERIC,
		DUE_DT TIMESTAMP WITHOUT TIME ZONE
	);
	LOOP
		INSERT INTO tt_INST_SCHDL_TEMP
		(
			AGRMNT_ID,
			INST_AMT,
			INST_PAID_AMT,
			DUE_DT
		)
		SELECT
			AGRMNT_ID,
			INST_AMT,
			INST_PAID_AMT,
			DUE_DT
		FROM 
			AR_INST_SCHDL
		LIMIT batch_size
		OFFSET v_offset;

		GET DIAGNOSTICS v_row_count = ROW_COUNT; -- Get the number of rows inserted
		-- Exit the loop if no more rows are inserted
		EXIT WHEN v_row_count < v_batch_size;

		v_offset := v_offset + batch_size;


	END LOOP;

	CREATE INDEX "ix_#inst_schdl_temp_agrmnt_id" ON tt_inst_schdl_temp (agrmnt_id);	


--==========================START INSERT SLIK_CREDIT_DTA QUERY==================================================
	RAISE NOTICE 'Start Insert SLIK_CREDIT_DTA';

	INSERT INTO public.SLIK_CREDIT_DTA(
		FLAG_DTL
		,PERIOD_MONTH
		,PERIOD_YEAR
		,NO_REK_FASILITAS
		,NO_CIF
		,KD_SIFAT_KREDIT
		,KD_JNS_KREDIT
		,AKAD_PEMBIAYAAN
		,NO_AKAD_AWAL
		,TGL_AKAD_AWAL
		,NO_AKAD_AKHR
		,TGL_AKAD_AKHR
		,BARU_PERPJGAN
		,TGL_AWAL_KREDIT
		,TGL_MULAI
		,TGL_JTH_TMP
		,KD_KTGR_DEBT
		,KD_JNS_PENGGUNAAN
		,KD_ORIENTASI_PENGGUNAAN
		,KD_SECTOR_ECONOMY
		,LOKASI_PROYEK_DATI2
		,NL_PROYEK
		,KD_VALUTA
		,PRCNTG_SUKU_BNG
		,JNS_SUKU_BNG
		,KREDIT_PEMBIAYAAN_PROG_PMRNTH
		,TAKE_OVER_DARI
		,SUMBER_DANA
		,PLAFON_AWAL
		,PLAFON
		,PNCAIRAN_BLN_BRJLN
		,DENDA
		,BAKI_DEBET
		,NL_DLM_MT_UANG_ASAL
		,KD_KOLEKTIBILITAS
		,TGL_MACET
		,KD_SEBAB_MACET
		,TUNGGAKAN_PKK
		,TUNGGAKAN_BNG
		,JMLH_HR_TUNGGAKAN
		,FREK_TUNGGAKAN
		,FREK_RESTRUKTURISASI
		,TGL_RESTRUKTUR_AWAL
		,TGl_RESTRUKTUR_AKHR
		,KD_CARA_RESTRUKTUR
		,KD_KONDISI
		,TGL_KONDISI
		,KETERANGAN
		,KD_KNTR_CBG
		,OPERASI_DATA
		,AGRMNT_NO
		,USR_CRT
		,DTM_CRT
		,USR_UPD
		,DTM_UPD
	)
	
   SELECT DISTINCT
		'D' 																							AS FlAgDtl,
		periodmonth 																					AS PeriodMonth,
		periodyear 																						AS Periodyear,
		AGR.AGRMNT_NO 																					AS NoRekFasilitas,
		CAC.ATTR_VALUE /*CUST.ID_NO*/ 																	AS NoCif,
		'9'																								AS KdSifatKredit,
		'P99' 																							AS KdJenisKredit,
		'000' 																							AS AkadPembiyaan,
		AGR.AGRMNT_NO 																					AS NoAkadAwal,
		CAST(CAST(TO_CHAR(AGR.GO_LIVE_DT,'yyyymmdd') AS VARCHAR(10)) AS TIMESTAMP)						AS TglAkadAwal,
		AGR.AGRMNT_NO 																					AS NoAkadAkhr,
		CAST(CAST(TO_CHAR(AGR.GO_LIVE_DT,'yyyymmdd') AS VARCHAR(10)) AS TIMESTAMP)						AS TglAkadAkhr,
		CAST('0' AS INTEGER) 																			AS BaruPerpjgan,
-- 		CAST(CAST(TO_CHAR(AGR.EFFECTIVE_DT,'yyyymmdd') AS VARCHAR(10)) AS TIMESTAMP)					AS TglAwalKredit,
		CAST(CAST(TO_CHAR(AGR.GO_LIVE_DT,'yyyymmdd') AS VARCHAR(10)) AS TIMESTAMP)					    AS TglAwalKredit,
		CAST(CAST(TO_CHAR(AGR.GO_LIVE_DT,'yyyymmdd') AS VARCHAR(10)) AS TIMESTAMP)						AS TglMulai,
		CAST(CAST(TO_CHAR(AGR.MATURITY_DT, 'yyyymmdd') AS VARCHAR(10)) AS TIMESTAMP) 					AS TglJthTmp
		, 'NU' 																							AS KdKtgrDebt
		, '3' 																							AS KdJnsPenggunaan
		, '3'																							AS KdOrientasiPenggunaan																										   																																
		,SUBSTR(GRM_ECO.GOV_RGLTN_CODE,1,6) /*SUBSTR(AGVRSEC.GOVERMENT_REGULATION_VALUE,1,6) */		AS KdSectorEconomy
		--, RPD.DISTRICT_REG_RPT_CODE/*COALESCE(SUBSTR(AAL.DISTRICT_REG_RPT_CODE,1,4),'')*/				AS LokasiProyekDati2
		, COALESCE(SUBSTR(RF.GOV_RGLTN_CODE, 1, 4),SUBSTR(RF2.GOV_RGLTN_CODE, 1, 4),SUBSTR(RF3.GOV_RGLTN_CODE, 1, 4),SUBSTR(RF4.GOV_RGLTN_CODE, 1, 4)) AS LokasiProyekDati2
		, CAST(NULL AS NUMERIC(17,2))/*0*//*CAST(AGR.TOTAL_ASSET_PRICE AS DECIMAL(15,0))*/ 											AS NlProyek
		,SUBSTR(CUR.CURR_CODE,1,4) 																		AS KdValuta
		,CAST(AGR.EFFECTIVE_RATE_PRCNT AS DECIMAL(10,3)) 												AS PrcntgSukuBng
		,CASE WHEN AGR.INTEREST_TYPE = 'FIXED' then '1' ELSE '2' END									AS JnsSukuBng
		,'10' 																							AS KreditPembiayaanProgPmrnth
		,'' 																							AS TakeOverDari
		,GRM_COMP.GOV_RGLTN_CODE																		AS SumberDana
		,CAST(FLOOR(1*AGR.NTF_AMT*COALESCE(PARAMS.VALUE,0)) AS DECIMAL(15,0))							AS PlafonAwal
		,CAST(FLOOR(1*AGR.NTF_AMT*COALESCE(PARAMS.VALUE,0))AS DECIMAL(15,0))							AS Plafon
		,CAST(
			CASE
				WHEN EXTRACT(MONTH FROM AGR.GO_LIVE_DT) = cast(NULLIF(PeriodMonth,'') as INTEGER) and EXTRACT(YEAR FROM AGR.GO_LIVE_DT) = cast(NULLIF(PeriodYear,'') as INTEGER)
					THEN CAST(FLOOR(AGR.NTF_AMT * COALESCE(PARAMS.VALUE,0)) AS DECIMAL(15,0))
			ELSE 0
			END AS DECIMAL(15,0)
		)																																		AS PncairanBlnBrjln
		,CAST(FLOOR(COALESCE(OS_LC_INST,0)*COALESCE(PARAMS.VALUE,0)) AS DECIMAL(15,0))															AS Denda
		,CAST(FLOOR(1*COALESCE(COALESCE(DA.OS_PRINCIPAL_TOTAL_AMT, AGR.OS_PRINCIPAL_AMT),0)*COALESCE(PARAMS.VALUE,0)) AS DECIMAL(15,0))		AS BakiDebet
		,CAST(NULL AS NUMERIC(17,2)) /*CAST(FLOOR(1*COALESCE(CAST(DA.OS_PRINCIPAL_TOTAL_AMT AS DECIMAL(15,0)),0)) AS DECIMAL(15,0))*/                                   AS NlDlmMtUangAsal
		/*,CASE
			WHEN AGR.CONTRACT_STAT_CODE IN('RRD','EXP','INV') /*AND ARRSDO.ASSET_NO IS NOT NULL AND ARRSHO.REQ_READY_SELL_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH'*/
			THEN '5'
			WHEN DA.AGING_DT != ScheduleEndDate OR AGR.CONTRACT_STAT_CODE IN('RRD','EXP')
			THEN '1'
			WHEN COALESCE(DA.DEFAULT_STAT_CODE,AGR.DEFAULT_STAT_CODE) = 'WO'
			THEN '5'
			WHEN AAM.RRD_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH'
			THEN '1'
			WHEN AGR.CONTRACT_STAT_CODE IN('RRD','EXP') AND AGR.DEFAULT_STAT_CODE IN('NM','NA') 
			THEN '1'
			ELSE COALESCE(DAL.LBPPMS_CLCTBLTY_CODE,AGR.LBPPMS_CLCTBLTY_CODE)
		END AS KdKolektibilitas */
		,COALESCE(DAL.LBPPMS_CLCTBLTY_CODE,
		   CASE WHEN AGR.CONTRACT_STAT_CODE IN ( 'ICP', 'EXP','RRD', 'LIV' ) 
			--AND ( AGR.OS_PRINCIPAL_AMT + AGR.OS_INTEREST_AMT = 0 )
				THEN '1'
				WHEN AGR.DEFAULT_STAT_CODE = 'WO' THEN '5'
		   END
		) 																																		AS KdKolektibilitas
		,CAST(CAST(TO_CHAR(CASE
			WHEN AGR.CONTRACT_STAT_CODE IN('INV') /*AND ARRSDO.ASSET_NO IS NOT NULL AND ARRSHO.REQ_READY_SELL_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH'*/
			THEN /*ARRSHO.REQ_READY_SELL_DT*/ NULL
			WHEN DA.AGING_DT != ScheduleEndDate OR AGR.CONTRACT_STAT_CODE IN('RRD','EXP')
			THEN NULL
			WHEN AGR.DEFAULT_STAT_CODE = 'WO'
			THEN AAM.WO_DT
			WHEN AAM.RRD_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH'
			THEN NULL
			/*WHEN COALESCE(DA.DAYS_OVER_DUE,0) -180 > 0
			THEN AAM.WO_DT /*ScheduleEndDate+CAST(-(COALESCE(DA.DAYS_OVER_DUE,0) -1) || 'day' as interval)*/*/
			ELSE NULL
		END,'yyyymmdd') AS VARCHAR(10)) AS TIMESTAMP)																							AS TglMacet
		,CASE
			WHEN AGR.CONTRACT_STAT_CODE IN('INV') /*AND ARRSDO.ASSET_NO IS NOT NULL AND ARRSHO.REQ_READY_SELL_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH'*/
			THEN '08'
			WHEN DA.AGING_DT != ScheduleEndDate OR AGR.CONTRACT_STAT_CODE IN('RRD','EXP')
			THEN ''
			WHEN AGR.DEFAULT_STAT_CODE = 'WO'
			THEN '08'
			WHEN AAM.RRD_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH'
			THEN ''
			WHEN COALESCE(DA.DAYS_OVER_DUE, 0) -180 > 0
			THEN '08'
			WHEN COALESCE(DAL.LBPPMS_CLCTBLTY_CODE,AGR.LBPPMS_CLCTBLTY_CODE) = '5' 
			THEN '08'
			-- WHEN KdKolektibilitas = '5' 
			-- THEN ''
			ELSE ''
		END																																		AS KodeSebabmacet
		,CAST(FLOOR(CASE
			WHEN(COALESCE(DA.OS_PRINCIPAL_TOTAL_AMT,0) -COALESCE(DA.OS_PRINCIPAL_UNDUE_AMT,0))*COALESCE(PARAMS.VALUE,0) < 0 then 0
			ELSE(COALESCE(DA.OS_PRINCIPAL_TOTAL_AMT,0) -COALESCE(DA.OS_PRINCIPAL_UNDUE_AMT,0))*COALESCE(PARAMS.VALUE,0)
			END) AS DECIMAL(15,0))																												AS TunggakanPkk
		,CAST(FLOOR(CASE
			WHEN(COALESCE(DA.OS_INTEREST_TOTAL_AMT,0) -COALESCE(DA.OS_INTEREST_UNDUE_AMT,0))*COALESCE(PARAMS.VALUE,0) < 0 then 0
			ELSE(COALESCE(DA.OS_INTEREST_TOTAL_AMT,0) -COALESCE(DA.OS_INTEREST_UNDUE_AMT,0))*COALESCE(PARAMS.VALUE,0)
			END) AS DECIMAL(15,0))																												AS TunggakanBng
		,CASE
			WHEN DA.CONTRACT_STAT_CODE IN('INV','RRD') /*AND ARRSDO.ASSET_NO IS NOT NULL*/
			THEN(case
			  when(AGR.OS_PRINCIPAL_AMT+AGR.OS_INTEREST_AMT) <= 0 then 0
			  else DATE_PART('day',ScheduleEndDate - AGR.NEXT_INST_DT)
			  end)
			ELSE COALESCE(COALESCE(DA.DAYS_OVER_DUE,0),0)
		END																																		AS JmlhHrTunggakan
		,COALESCE(FREK_TUNGGAKAN_COUNT,0) /*CAST(COALESCE(CEIL(COALESCE(DA.DAYS_OVER_DUE,0)/30.00),0) AS DECIMAL(3,0))*/																	AS FrekTunggakan --INSTSCHDL, END DATE sampe tanggal DUE DATE<END DATE dan inst amt - paid AMT >0 
		,COALESCE(CAST(RESCT.NUM_OF_RESCT AS DECIMAL(5,0)),COALESCE(CAST(RSC.NUM_RESCH AS DECIMAL(5,0)),cast('0' as DECIMAL))) 												AS FrekRestrukturisasi
		,CAST(COALESCE(CAST(TO_CHAR(RESCT.AGRMNT_DT,'yyyymmdd') AS VARCHAR(10)),COALESCE(CAST(TO_CHAR(RSC.MIN_RESCH_DT,'yyyymmdd') AS VARCHAR(10)),NULL)) AS TIMESTAMP)		AS TglRestrukturAwal
		,CAST(COALESCE(CAST(TO_CHAR(RESCT.LAST_AGRMNT_DT,'yyyymmdd') AS VARCHAR(10)), COALESCE(CAST(TO_CHAR(RSC.MAX_RESCH_DT,'yyyymmdd') AS VARCHAR(10)),NULL)) AS TIMESTAMP)AS TglRestrukturAkhr
		,CASE WHEN RSC.AGRMNT_ID is not null then '99' else COALESCE(SUBSTR(AGVRWOR.GOVERMENT_REGULATION_VALUE,1,2),'') End													AS KdCaraRestruktur
		,COALESCE(CASE
			WHEN ARX.AGRMNT_ID IS NOT NULL THEN '02'
			WHEN DA.CONTRACT_STAT_CODE IN('LIV','ICP','ICL','INV') AND DA.DEFAULT_STAT_CODE IN('NM','NA') AND DA.AGING_DT = ScheduleEndDate THEN '00'
			WHEN DA.CONTRACT_STAT_CODE IN('LIV','ICP','ICL','INV') AND DA.DEFAULT_STAT_CODE IN('WO') AND DA.AGING_DT = ScheduleEndDate THEN '03'
			WHEN AGR.CONTRACT_STAT_CODE IN('INV') AND AGR.DEFAULT_STAT_CODE IN('NM','NA') THEN '00'
			WHEN AGR.CONTRACT_STAT_CODE IN('INV') AND AGR.DEFAULT_STAT_CODE IN('WO') THEN '03'
			WHEN AGR.CONTRACT_STAT_CODE IN('RRD','EXP') AND AGR.DEFAULT_STAT_CODE IN('NM','NA') THEN '02'
		END,'')																																									AS KdKondisi
		,CAST(REPLACE((CAST(TO_CHAR(CASE
			WHEN DA.CONTRACT_STAT_CODE IN('LIV','ICP','ICL','INV') AND DA.DEFAULT_STAT_CODE IN('WO') AND DA.AGING_DT = ScheduleEndDate
			THEN CASE WHEN AAM.WO_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH' THEN AAM.WO_DT END
			WHEN AGR.CONTRACT_STAT_CODE IN('INV') AND AGR.DEFAULT_STAT_CODE IN('WO')
			THEN CASE WHEN AAM.WO_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH' THEN AAM.WO_DT END
			WHEN AGR.CONTRACT_STAT_CODE IN('RRD','EXP') /*AND ARRSDO.ASSET_NO IS NOT NULL*/
			THEN
			  CASE
			  WHEN AAM.RRD_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH' THEN AAM.RRD_DT
			  ELSE null
			  END
			WHEN AGR.CONTRACT_STAT_CODE IN('RRD','EXP') AND AGR.DEFAULT_STAT_CODE IN('NM','NA','WO')
			THEN CASE WHEN AAM.RRD_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH' THEN AAM.RRD_DT END
			WHEN AGR.CONTRACT_STAT_CODE IN('RRD','EXP') AND AGR.DEFAULT_STAT_CODE IN('NM','NA','WO')
			THEN CASE WHEN AAM.RRD_DT < CAST(COALESCE(PeriodYear,'') || '-' || COALESCE(PeriodMonth,'')|| '-1' AS TIMESTAMP)+INTERVAL '1 MONTH' THEN AAM.RRD_DT END
		END,'yyyymmdd') AS VARCHAR(10))),'19000101','') AS TIMESTAMP)																											AS TglKondisi
		,''																																																							as Keterangan
		,GRM_OFFICE.GOV_RGLTN_CODE																																																	as KdKntrCbg
			,CASE WHEN COALESCE(EXTRACT(MONTH FROM AGR.GO_LIVE_DT),0) = cast(NULLIF(PeriodMonth,'') as INTEGER) and COALESCE(EXTRACT(year FROM AGR.GO_LIVE_DT),0) = cast(NULLIF(PeriodYear,'') as INTEGER) then 'C'ELSE 'U' END AS OperasiData 
		,AGR.AGRMNT_NO																																																				AS AGRMNT_NO
		,COALESCE("user",CURRENT_USER)																																																AS UsrCrt
		,LOCALTIMESTAMP																																																				AS DtmCrt
		,COALESCE("user",CURRENT_USER)																																																AS UsrUpd
		,LOCALTIMESTAMP																																																				AS DtmUpd
	FROM /*tt_AGRMNT_ASSET_CTE AAC 
	INNER JOIN*/ tt_AGRMNT_TEMP AGR  /*ON AAC.AGRMNT_ID = AGR.AGRMNT_ID*/
	--INNER JOIN public.AR_AGRMNT_ASSET AA  ON AAC.AGRMNT_ID = AA.AGRMNT_ID
	INNER JOIN tt_CUST_ADDR_TEMP CA  ON AGR.CUST_NO = CA.CUST_NO
	LEFT JOIN (SELECT DISTINCT REF_PROV_DISTRICT_ID, ZIPCODE, AREA_CODE_1, AREA_CODE_2, CITY FROM tt_ZIPCODE_DATA) RZ 
	
	INNER JOIN public.FOUNDATION_REF_PROV_DISTRICT RPD 
	ON RZ.REF_PROV_DISTRICT_ID = RPD.REF_PROV_DISTRICT_ID
	ON RZ.ZIPCODE = CA.ZIPCODE AND RZ.AREA_CODE_1 = CA.AREA_CODE_1 AND RZ.AREA_CODE_2 = CA.AREA_CODE_2 AND RZ.CITY = CA.CITY
	LEFT JOIN REF_GOV_RGLTN_MAPPING RF ON RPD.prov_district_code = RF.entity_code AND RF.ENTITY_TYPE = 'PROV_DISTRICT_CODE' AND RF.GOV_RGLTN_TYPE = 'SLIK'

	LEFT JOIN (SELECT DISTINCT REF_PROV_DISTRICT_ID, ZIPCODE, AREA_CODE_1, AREA_CODE_2 FROM tt_ZIPCODE_DATA) RZ2
	INNER JOIN public.FOUNDATION_REF_PROV_DISTRICT RPD2 
	ON RZ2.REF_PROV_DISTRICT_ID = RPD2.REF_PROV_DISTRICT_ID
	ON RZ2.ZIPCODE = CA.ZIPCODE AND RZ2.AREA_CODE_1 = CA.AREA_CODE_1 AND RZ.AREA_CODE_2 = CA.AREA_CODE_2
	LEFT JOIN REF_GOV_RGLTN_MAPPING RF2 ON RPD2.prov_district_code = RF2.entity_code AND RF2.ENTITY_TYPE = 'PROV_DISTRICT_CODE' AND RF2.GOV_RGLTN_TYPE = 'SLIK'

	LEFT JOIN (SELECT DISTINCT REF_PROV_DISTRICT_ID, ZIPCODE, AREA_CODE_1 FROM tt_ZIPCODE_DATA) RZ3
	INNER JOIN public.FOUNDATION_REF_PROV_DISTRICT RPD3 
	ON RZ3.REF_PROV_DISTRICT_ID = RPD3.REF_PROV_DISTRICT_ID
	ON RZ3.ZIPCODE = CA.ZIPCODE AND RZ3.AREA_CODE_1 = CA.AREA_CODE_1
	LEFT JOIN REF_GOV_RGLTN_MAPPING RF3 ON RPD3.prov_district_code = RF3.entity_code AND RF3.ENTITY_TYPE = 'PROV_DISTRICT_CODE' AND RF3.GOV_RGLTN_TYPE = 'SLIK'

	LEFT JOIN (SELECT DISTINCT REF_PROV_DISTRICT_ID, ZIPCODE FROM tt_ZIPCODE_DATA) RZ4 
	ON RZ4.ZIPCODE = CA.ZIPCODE
	INNER JOIN public.FOUNDATION_REF_PROV_DISTRICT RPD4 
	ON RZ4.REF_PROV_DISTRICT_ID = RPD4.REF_PROV_DISTRICT_ID
	LEFT JOIN REF_GOV_RGLTN_MAPPING RF4 ON RPD4.prov_district_code = RF4.entity_code AND RF4.ENTITY_TYPE = 'PROV_DISTRICT_CODE' AND RF4.GOV_RGLTN_TYPE = 'SLIK'

	LEFT JOIN tt_AGRMNT_RESCH RSC  ON AGR.AGRMNT_ID = RSC.AGRMNT_ID
	LEFT JOIN public.AMENDMENT_AMENDMENT_HIST_TRX AHT  ON RSC.MAX_AMENDMENT_HIST_TRX_ID = AHT.AMENDMENT_HIST_TRX_ID
	LEFT JOIN AR_REFUND_AGRMNT_X ARX ON AGR.AGRMNT_ID = ARX.AGRMNT_ID
	LEFT JOIN(
		SELECT b.* from public.FOUNDATION_CUST_OTHER_INFO b
		INNER JOIN(
			SELECT cust_id , max(a.CUST_OTHER_INFO_ID) AS CUST_OTHER_INFO_ID 
			from public.FOUNDATION_CUST_OTHER_INFO a  
			group by cust_id
		) a on a.cust_id = b.cust_id and b.CUST_OTHER_INFO_ID = a.CUST_OTHER_INFO_ID
	) COI ON CA.CUST_ID = COI.CUST_ID
	LEFT JOIN public.LBPPMS_BIZ_SCL LBC  ON COI.LBPPMS_BIZ_SCL_CODE = LBC.LBPPMS_BIZ_SCL_CODE
	LEFT JOIN public.REF_SLIK_CODE RSC_BIZ_SCALE  ON LBC.LBPPMS_BIZ_SCL_CODE = RSC_BIZ_SCALE.MASTER_CODE AND RSC_BIZ_SCALE.REF_MASTER_TYPE_CODE = 'BIZ_SCALE'
	LEFT JOIN tt_agrmnt_government_regulation AGVRWOR ON AGR.AGRMNT_ID = AGVRWOR.AGRMNT_ID AND AGVRWOR.GOVERMENT_REGULATION_CODE = 'WAY_OF_RESCT' -- CHANGED FROM INNER
	
	-- INNER JOIN public.tt_agrmnt_government_regulation AGVRSEC  ON AGR.AGRMNT_ID = AGVRSEC.AGRMNT_ID AND AGVRSEC.GOVERMENT_REGULATION_CODE = 'SLIK_ECO_CODE' -- AGVRSEC, USED, NO DATA (CHANGED TO )
	LEFT JOIN FOUNDATION_CUST_PERSONAL_JOB_DATA CPJD ON CA.CUST_ID = CPJD.CUST_ID
	LEFT JOIN FOUNDATION_REF_INDUSTRY_TYPE RIT ON CPJD.REF_INDUSTRY_TYPE_ID = RIT.REF_INDUSTRY_TYPE_ID
	LEFT JOIN public.REF_GOV_RGLTN_MAPPING GRM_ECO ON RIT.INDUSTRY_TYPE_CODE = GRM_ECO.ENTITY_CODE AND GRM_ECO.GOV_RGLTN_TYPE = 'SLIK' AND GRM_ECO.ENTITY_TYPE = 'INDUSTRY_TYPE_CODE'
	
	LEFT JOIN(
		SELECT a.GOVERMENT_REGULATION_VALUE,COUNT(a.GOVERMENT_REGULATION_VALUE) AS NUM_OF_RESCT, b.AGRMNT_NO, b.AGRMNT_DT,b.GO_LIVE_DT,MAX(C.AGRMNT_DT) AS LAST_AGRMNT_DT
		FROM tt_agrmnt_government_regulation a 
		INNER JOIN tt_AGRMNT_TEMP b  ON a.AGRMNT_ID = b.AGRMNT_ID AND a.GOVERMENT_REGULATION_CODE = 'PREV_AGRMNT_NO'
		INNER JOIN tt_AGRMNT_TEMP C  ON a.AGRMNT_ID = C.AGRMNT_ID
		WHERE a.GOVERMENT_REGULATION_VALUE IS NOT NULL
		GROUP BY a.GOVERMENT_REGULATION_VALUE,b.AGRMNT_DT,b.GO_LIVE_DT,b.AGRMNT_NO) RESCT ON AGVRWOR.AGRMNT_ID = cast(NULLIF(RESCT.GOVERMENT_REGULATION_VALUE,'') as BIGINT)
	-- INNER JOIN public.tt_agrmnt_government_regulation AGVRFINPRPS  ON AGR.AGRMNT_ID = AGVRFINPRPS.AGRMNT_ID AND AGVRFINPRPS.GOVERMENT_REGULATION_CODE = 'FINPURPOSE' -- AGVRFINPRPS NOT USED
	/*LEFT JOIN(SELECT  AST.ASSET_NO,
			RPD.DISTRICT_REG_RPT_CODE
	  FROM public.ASSET_ASSET_REGISTRATION AAR 
	  INNER JOIN public.FOUNDATION_REF_ZIPCODE RZC  ON AAR.OWNER_ZIPCODE = RZC.ZIPCODE AND AAR.OWNER_CITY = RZC.CITY AND AAR.OWNER_AREA_CODE_1 = RZC.AREA_CODE_1
	  AND AAR.OWNER_AREA_CODE_2 = RZC.AREA_CODE_2
	  INNER JOIN public.FOUNDATION_REF_PROV_DISTRICT RPD  ON RZC.REF_PROV_DISTRICT_ID = RPD.REF_PROV_DISTRICT_ID
	  INNER JOIN public.ASSET_ASSET AST  ON AAR.ASSET_ID = AST.ASSET_ID) AAL ON AAL.ASSET_NO = AAC.ASSET_NO*/
	INNER JOIN public.FOUNDATION_REF_CURR CUR  ON AGR.CURR_CODE = CUR.CURR_CODE
	LEFT JOIN(SELECT 
			PARAM_TYPE, 
			VALUE
		FROM public.SCHDL_PARAM 
		WHERE SCHDL_LOG_ID = ScheduleID
	) PARAMS ON PARAMS.PARAM_TYPE = CUR.CURR_CODE
	INNER JOIN public.FOUNDATION_REF_COY COY  ON 1 = 1
	LEFT JOIN public.DAILY_AGING_LBPP DAL  ON AGR.AGRMNT_NO = DAL.AGRMNT_NO AND AGING_DT = ScheduleEndDate
	INNER JOIN tt_AGRMNT_ACC_MNT_TEMP AAM  ON AGR.AGRMNT_ID = AAM.AGRMNT_ID -- MASUKIN AR_AGRMNT_ACC_MNT KE TEMP TABLE
	INNER JOIN tt_DAILY_AGING_TEMP DA  ON AGR.AGRMNT_ID = DA.AGRMNT_ID
	LEFT JOIN public.AMENDMENT_RESCH_TRX RT  ON RSC.MAX_AMENDMENT_HIST_TRX_ID = RT.AMENDMENT_HIST_TRX_ID
	INNER JOIN public.FOUNDATION_REF_OFFICE RO  ON RO.OFFICE_CODE = AGR.OFFICE_CODE
	-- LEFT JOIN public.AR_AR_ACCOUNTING_H AAH  ON AGR.AGRMNT_ID = AAH.AGRMNT_ID AND AAH.AGING_DT = ScheduleEndDate --GA DIPAKE DIMANA-MANA
	-- LEFT JOIN public.AR_INST_SCHDL INST  ON INST.AGRMNT_ID = AGR.AGRMNT_ID AND INST.INST_SEQ_NO = AGR.NUM_OF_INST
	-- LEFT JOIN public.REF_SLIK_CODE RSC_OFFICE  ON AGR.OFFICE_CODE = RSC_OFFICE.MASTER_CODE AND RSC_OFFICE.REF_MASTER_TYPE_CODE = 'OFFICE_CODE' -- RSC_OFFICE USED, CHANGED TO 
	LEFT JOIN public.REF_GOV_RGLTN_MAPPING GRM_OFFICE  ON AGR.OFFICE_CODE = GRM_OFFICE.ENTITY_CODE AND GRM_OFFICE.ENTITY_TYPE = 'OFFICE_CODE' AND GRM_OFFICE.GOV_RGLTN_TYPE = 'SLIK'
	LEFT JOIN public.REF_GOV_RGLTN_MAPPING GRM_COMP  ON 1 = 1 AND GRM_COMP.ENTITY_TYPE = 'COMPANY_CODE' AND GRM_COMP.GOV_RGLTN_TYPE = 'SLIK'
	LEFT JOIN (
		SELECT a.AGRMNT_ID, COUNT(*) FREK_TUNGGAKAN_COUNT
		FROM tt_AGRMNT_TEMP a
		INNER JOIN (
			SELECT * FROM tt_INST_SCHDL_TEMP b --Buat jadi Temp Table
			WHERE DUE_DT <= scheduleenddate AND (b.INST_AMT-b.INST_PAID_AMT)>0
			) b ON a.AGRMNT_ID = b.AGRMNT_ID
		GROUP BY a.AGRMNT_ID
	) INST ON AGR.AGRMNT_ID = INST.AGRMNT_ID
	LEFT JOIN (
		SELECT a.CUST_ID, a.ATTR_VALUE
		FROM FOUNDATION_CUST_ATTR_CONTENT a
		INNER JOIN FOUNDATION_REF_ATTR b ON a.REF_ATTR_ID = b.REF_ATTR_ID 
		WHERE b.ATTR_CODE = 'CIF'
	) CAC ON CA.CUST_ID = CAC.CUST_ID
	WHERE (ARX.REFUND_TIME IS NULL
	OR ((EXTRACT(MONTH FROM ARX.REFUND_TIME) != EXTRACT(MONTH FROM AGR.GO_LIVE_DT)) 
	OR(EXTRACT(YEAR FROM ARX.REFUND_TIME) != EXTRACT(YEAR FROM AGR.GO_LIVE_DT)))
	)
	AND
	(AAM.RRD_DT IS NULL
    OR (EXTRACT(MONTH FROM AAM.RRD_DT) != EXTRACT(MONTH FROM AGR.GO_LIVE_DT))
	OR (EXTRACT(YEAR FROM AAM.RRD_DT) != EXTRACT(YEAR FROM AGR.GO_LIVE_DT)));
	--LEFT JOIN public.STORAGE_ASSET_REQ_READY_SELL_D_OPL ARRSDO  ON AA.ASSET_NO = ARRSDO.ASSET_NO
	--LEFT JOIN public.STORAGE_ASSET_REQ_READY_SELL_H_OPL ARRSHO  ON ARRSDO.ASSET_REQ_READY_SELL_H_OPL_ID = ARRSHO.ASSET_REQ_READY_SELL_H_OPL_ID;
	
   DROP TABLE IF EXISTS tt_DAILY_AGING_TEMP CASCADE;
   --DROP TABLE IF EXISTS tt_AGRMNT_ASSET_CTE CASCADE;
   DROP TABLE IF EXISTS tt_AGRMNT_RESCH CASCADE;
   DROP TABLE IF EXISTS tt_TEMP_LC_ON_THE_FLY CASCADE;
   DROP TABLE IF EXISTS tt_AGRMNT_TEMP CASCADE;
   DROP TABLE IF EXISTS tt_ZIPCODE_DATA CASCADE;
   DROP TABLE IF EXISTS tt_CUST_ADDR_TEMP CASCADE;
END; 
$BODY$;

ALTER FUNCTION public.spslik_gendataf01(timestamp without time zone, timestamp without time zone, character varying, character varying, character varying, bigint)
    OWNER TO postgres;
