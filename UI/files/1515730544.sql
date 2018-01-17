USE [COOP]
GO

/****** Object:  Table [dbo].[Location]    Script Date: 07/09/2017 20:29:07 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Location](
	[idLocation] [int] NOT NULL,
	[Location] [varchar](50) NOT NULL,
	[Location_Status] [varchar](50) NOT NULL,
	[Control_Number] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Location] PRIMARY KEY CLUSTERED 
(
	[idLocation] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Location]  WITH CHECK ADD  CONSTRAINT [FK_Location_Tracking] FOREIGN KEY([Control_Number])
REFERENCES [dbo].[Tracking] ([Control_Number])
GO

ALTER TABLE [dbo].[Location] CHECK CONSTRAINT [FK_Location_Tracking]
GO

