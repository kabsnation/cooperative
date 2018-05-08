USE [COOP2]
GO

/****** Object:  Table [dbo].[Account_Info]    Script Date: 30/06/2017 20:43:21 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Account_Info](
	[AccountInfo_ID] [int] IDENTITY(1,1) NOT NULL,
	[First_Name] [varchar](35) NOT NULL,
	[Last_Name] [varchar](35) NOT NULL,
	[Middle_Name] [varchar](35) NOT NULL,
	[Name_Suffix] [varchar](35) NOT NULL,
	[Cellphone_Number] [numeric](11, 0) NOT NULL,
	[Sex] [varchar](6) NOT NULL,
	[Home_Address] [varchar](50) NOT NULL,
	[City] [varchar](50) NOT NULL,
	[Barangay] [varchar](50) NOT NULL,
	[Email_Address] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Account_Info] PRIMARY KEY CLUSTERED 
(
	[AccountInfo_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

